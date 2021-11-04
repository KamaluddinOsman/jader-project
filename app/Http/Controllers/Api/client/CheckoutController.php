<?php

namespace App\Http\Controllers\Api\client;

use App\Address;
use App\BankAccount;
use App\Car;
use App\Cart;
use App\Client;
use App\DeliveryCost;
use App\DriversRequests;
use App\ExtraProduct;
use App\MoneyAccount;
use App\ProductAttrItem;
use App\Store;
use App\Order;
use App\OrderItem;
use App\Payment;
use App\Product;
use App\OrderProduct;
use App\Mail\OrderPlaced;
use App\UnitColor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CheckoutRequest;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Cartalyst\Stripe\Exception\CardErrorException;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Ramsey\Uuid\Uuid;
use DateTime;


class CheckoutController extends Controller
{

    public function store(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'payment' => ['required', Rule::in(['cash', 'visa'])],
            'address_id' => 'required',
            'car_type' => 'required',
            'bank_account' => 'required',
            'client_id' => 'required',
        ]);

        if ($validator->fails()) {
            return ResponseJson('0', $validator->errors()->first(), null);
        }

 
       if ($request->payment == 'cash') {
        
         $order = Order::orWhere('status','new')
         ->orWhere('status','accept')->orWhere('status','unpaid')->orWhere('status','padding')->where('client_id', $request->client_id )->get();
                

         // return ResponseJson('0', $order->count(), $order->count() >=  1);

         if($order->count() >= 1 ){
           return ResponseJson('0', 'يوجد لك طلب حالي كاش لم ينتهي يجب الانتظار انهاء هذا الطلب لكي تستطيع طلب واحد اخر', null);
         }
         
        } 
  
     
        $client = Client::where('id', $request->client_id)->first();
        $clientID = $client->id;
        $carts = Cart::where('client_id', $client->id)->get();
        $address_id = $request->address_id;
        $car_type = $request->car_type;
        $address = Address::where('id', $address_id)->first();
        $sippingPrice = $this->ShippingAmount($client, $request->address_id, $request->car_type);

        if ($carts->count() == 0) {
            return ResponseJson('0', 'لاتوجد منتجات فى السلة', null);
        }

        // Check race condition when there are less items available to purchase
        if ($this->productsAreNoLongerAvailable($request->client_id) == false) {
            return ResponseJson('0', 'نأسف لك هذا المنتج اكبر من الكميه المتاحه لدينا');
        }

        $value_added_tax = settings()->value_added_tax;  //القيمه المضافة
        $sumTotal = $carts->sum("total_price") + $sippingPrice;

        $order = new Order();
        $order->client_id = $client->id;
        $order->store_id = $carts[0]->store_id;
        $order->name_buyer = $client->full_name;
        $order->payment = $request->payment;
        $order->status = 'unpaid';
        $order->address_id = $request->address_id;
        $order->description = $request->description;
        $order->billing_address = $address->state;
        $order->billing_phone = $client->phone;
        $order->billing_subtotal = $sumTotal;
        $order->billing_tax = '10';
        $order->billing_total = $sumTotal; //الضريبه // اجمالى الفواتير فى الكميه -
        $order->shipped = $sippingPrice; //مبلغ الشحن

        $order->save();

        $items = [];
        foreach ($carts as $cart) {
            $items[] = [
                'order_id' => $order->id,
                'product_id' => $cart->product_id,
                'store_id' => $cart->store_id,
                'price' => $cart->total_price,
                'quantity' => $cart->quantity,
                'original_price' => $cart->original_price,
                'discount' => $cart->discount,
                'product_attr' => $cart->product_attr,
                'size_id' => $cart->size_id,
                'color_id' => $cart->color_id,
                'status' => 'pending',
                'delivery_date' => Carbon::now()  //تاريخ الشحن
            ];

            $prod = Product::findOrFail($cart->product_id);
            $prod->rest_quantity = $prod->rest_quantity - $cart->quantity;
            $prod->save();

            if ($prod->rest_quantity <= 5) {
                $client_id = Store::where('id', $cart->store_id)->pluck('client_id')->first();
                $client = Client::where('id', $client_id)->first();

                $notification = $client->notifications()->create([
                    'id' => Uuid::uuid4(),
                    'order_id' => $order->id,
                    'type' => 'store',
                    'title' => 'هناك منتج اقترب من الانتهاء',
                    'body' => $prod->name . ' ' . 'اقترب من الانتهاء يرجى مراجعته',
                ]);

                $tokens = $client->tokens()->where('token', '!=', '')->pluck('token')->toArray();

                if (count($tokens)) {
                    $title = $notification->title;
                    $body = $notification->body;
                    $data = [
                        'order_id' => $order->id,
                        'typeScreen' => 1 ,/// car 1 -- store 2 --- client 3
                    ];
                    $send = notifyByFirebase($title, $body, $tokens, $data);
                }

            }
        }

        $order_id = $order->id;
        DB::table('order_items')->insert($items);

        $address = Address::where('id', $request->address_id)->first();
        $long = $address->lang;
        $lat = $address->late;

        

   
        if ($request->payment == 'cash') {
            
        DB::table('cart')->where('client_id', $client->id)->delete();

//            الدفع كاش
            $this->NearbyCars($order_id, $lat, $long, $request->car_type, $client->id, $request->address_id, $sippingPrice);

        } elseif ($request->payment = 'visa') {
//            الدفع اونلاين
            $bankAccount = BankAccount::where('id', $request->bank_account)->first();

            if (!$bankAccount) {
                return ResponseJson('0', 'تأكد من ادخال رقم حساب', null);
            }

        DB::table('cart')->where('client_id', $client->id)->delete();
            //التحويل لشاشة الدفع
            return view('admin.payment.payment', compact('sumTotal', 'bankAccount', 'clientID', 'address_id', 'car_type', 'order_id'));

        } else {
            $bounced_back = MoneyAccount::where('client_id', $request->client_id)->where('status', 'bounced_back')->sum('total_money');
            if ($sumTotal > $bounced_back) {
                return ResponseJson('0', 'عفوا المبلغ الذى لديك فى المحفظه اقل من قيمة الطلب', $order->id);
            } else {

                $this->NearbyCars($order_id , $lat , $long , $request->car_type , $client->id , $request->address_id , $sippingPrice);
                
                $money = new MoneyAccount();

                if ($request->type == 'client') {
                    $money->client_id = $request->client_id;
                }

                $money->user_id = auth()->id();
                $money->client_money = '-'.$sumTotal;
                $money->status = 'bounced_back';
                $money->note = 'الدفع عن طريق المحفظه';
                $money->total_money = '-'.$sumTotal;
                $money->transfer_Number = $request->input('transfer_Number');
                $money->save();

            }
        }


        return ResponseJson('200', 'تم ارسال الطلب ', $order->id);
    }

    protected function ShippingAmount($clientID, $address, $TypeCar)
    {
        $address = Address::where('id', $address)->first();
        $carts = Cart::where('client_id', $clientID->id)->get();

        if (!$address) {
            return ResponseJson('0', 'تأكد من البيانات');
        }

        if (empty(count($carts))) {
            return ResponseJson('0', 'نأسف لك لا يوجد اى منتجات لك فى سلة المشتريات');
        }

        $clientDis = $address->late . ',' . $address->lang;
        $storeDis = $carts[0]->store->late . ',' . $carts[0]->store->lang;
        $distance = getMoreDistance($clientDis, $storeDis, true, true);
        $a = (int)round($distance['distance']);
        $deliveryCost = DeliveryCost::where('from_k', '<=', $a)->where('to_k', '>=', $a)->where('type_car', $TypeCar)->first();

        $sippingPrice = collect([$deliveryCost->from_price, $deliveryCost->to_price])->avg();

        if (!$deliveryCost) {
            return ResponseJson('0', 'عذراً حدث مشكلة نأسف لك', null);
        }

        return $sippingPrice;

    }

    public function BackPaymentCheckout(Request $request)
    {

        $clientId = $request->client_id;
        $addressId = $request->address_id;
        $Car_type = $request->car_type;

        $payment = new Payment();
        $payment->id_pay = $request->id;
        $payment->order_id = $request->order_id;
        $payment->status = $request->status;
        $payment->message = $request->message;
        $payment->amount = $request->amount;
        $payment->save();

        if ($request->status == 'paid') {

            //        DB::table('cart')->where('client_id', $client->id)->delete();

            $track = [
                'order_id' => $request->order_id,
                'time' => Carbon::now()->format('H:i:s'),
                'status' => 'paid',
                'statusName' => 'تم الدفع بنجاح',
            ];
            DB::table('track_order')->insert($track);

            $order = Order::where('id', $request->order_id)->first();
            $order->status = 'paid';
            $order->save();

            $address = Address::where('id', $addressId)->first();
            $long = $address->lang;
            $lat = $address->late;

            $this->NearbyCars($request->order_id, $lat, $long, $Car_type, $clientId, $addressId, $order->shipped);

            return view('admin.payment.success');
        } else {
            return view('admin.payment.failed');
        }
    }

    //New Request Driver
    public function NewOrdersDriver()
    {
        $client = Auth::id();
        $driver = Car::where('client_id', $client)->first();

        if (empty($driver)) {
            return ResponseJson('200', 'لا يوجد لك سيارة ', null);
        }

        $requests = DriversRequests::with('address')->where('car_id', $driver->id)->get();

  
        if ($requests->isEmpty()) {
            return ResponseJson('0', 'لا يوجد لك عروض ', null);
        }

            
        $c = [];

        foreach ($requests as $row) {
 
        if ($row->address == null ) {
            return ResponseJson('0', 'لا يوجد عنوان للسياره ', null);
        }

            //  hour minute day
            $DateToDayNows = new DateTime();
            $formattedNow = date_format($DateToDayNows, "Y-m-d H:i:s");
            $dateToDayCreated = $row->created_at ;

            $dateToDayCreated->modify('+5 mint');

            $formattedEnd = date_format($dateToDayCreated, "Y-m-d H:i:s");


            if (strtotime($formattedNow) > strtotime($formattedEnd)) {
                       
                       
            $orderRequest = DriversRequests::where('order_id', $row->order_id)->get();
            $current = Auth::id();
    
            $client = Client::where('id', $current)->first();
            //  return $client;
      
  
        if ($orderRequest){
      
      
      foreach ($orderRequest as $item) {
          
        $order =  Order::where('id',$item->order_id)->get();
       
           
         $item->delete();
                  
        }
        
        Order::where('id',$row->order_id)->update(['status' => 'cancel']);
        
            //send notification to client
                $notification = $client->notifications()->create([
                    'id' => Uuid::uuid4(),
                    'order_id' => $row->order_id,
                    'type' => 'client',
                    'title' => 'تم الغاء هذا الاوردر',
                    'body' => 'بسبب ان المشأه مشغوله ممكن ان تحاول مره اخري ',
                ]);
                
                
                 $tokens = $client->tokens()->where('token', '!=', '')->pluck('token')->toArray();
                 
             //    return $tokens;
                if (count($tokens)) {
                    $title = $notification->title;
                    $body = $notification->body;
                    $data = [
                        'order_id' => $row->order_id,
                      'typeScreen' => 3 ,/// car 1 -- store 2 --- client 3

                    ];
                    $send = notifyByFirebase($title, $body, $tokens, $data);
                }
  
        }  
                       
                       
                         
            }
            else{
                
                
            $langFromClient = (float)$row->address->lang;
            $lateFromClient = (float)$row->address->late;
            $to_latlong = $lateFromClient . ',' . $langFromClient;

            $order = Order::with('store')->where('id', $row->order_id)->first();
            
            
            if($order != null){
                
            //store
            $langFromStore = (float)$order->store->lang;
            $lateFromStore = (float)$order->store->late;
            $dests = $lateFromStore . ',' . $langFromStore;

            $distanceBetweenStoreClient = getMoreDistance($dests, $to_latlong, true, true);

            //Driver
            $langFromDriver = (float)$driver->lang;
            $lateFromDriver = (float)$driver->late;
            $Driverdests = $lateFromDriver . ',' . $langFromDriver;
            $distanceBetweenStoreDriver = getMoreDistance($Driverdests, $dests, true, true);

          
             $item = [];


            $c[$row->client_id]["info"] = [
                "order_id" => $order->id,
                "id" => $row->id,
                "client_name" => $order->name_buyer,
                "billing_total" => $order->billing_total,
                "phone" => $order->billing_phone,
                "durationBetweenStoreClient" => $distanceBetweenStoreClient['duration'],
                "distanceBetweenStoreClient" => (int)round($distanceBetweenStoreClient['distance']),
                "langClient" => $langFromClient,
                "latClient" => $lateFromClient,
                "address" => $order->billing_address,
                "Store_name" => $order->store->name,
                "Store_logo" => $order->store->logo,
                "langStore" => $langFromStore,
                "latStore" => $lateFromStore,
                "durationBetweenStoreDriver" => $distanceBetweenStoreDriver['duration'],
                "distanceBetweenStoreDriver" => (int)round($distanceBetweenStoreDriver['distance']),
                "langDriver" => $langFromDriver,
                "latDriver" => $lateFromDriver,
            ];
            $c = array_values((array)$c);
                
           }
 
           }
            
            //client
        

        }

        return ResponseJson('200', 'طلب جديد', $c);
    }

    //Details of drivers' requests
    public function DetailsNewOrder($id)
    {


        $products = [];
        $extra = '';
        $remove = '';
        $size = '';

        $order_id = $id;

        $order = Order::with('items', 'client', 'store', 'address')->where('id', $order_id)->first();

       

        $langFromClient = (float)$order->address->lang;
        $lateFromClient = (float)$order->address->late;

        $info = [
            "StoreName" => $order->store->name,
            "StoreLogo" => $order->store->logo,
            "addressStore" => $order->store->address,
            "total_Price" => $order->billing_total,
            "shipping" => $order->shipped,
            "langStore" => $order->store->lang,
            "lateStore" => $order->store->late,

            "ClientName" => $order->name_buyer,
            "ClientPhone" => $order->billing_phone,
            "addressClient" => $order->address->state,
            "langClient" => $langFromClient,
            "lateClient" => $lateFromClient
        ];


//        $info = array_values((array)$info);

        $choices = [];

        foreach ($order->items as $key => $value) {
            $product = Product::where('id', $value->product_id)->get();
            $items = OrderItem::where('id', $value->id)->get();

            foreach ($items as $item) {

                if ($item->product_attr) {
                    $ids = json_decode($item->product_attr);
                    $productschoices = ProductAttrItem::whereIn('id', $ids)->with('ProductAttr')->get();
                    foreach ($productschoices as $choice) {
                        $choices[$choice->product_attr_id]['id'] = $choice->product_attr_id;
                        $choices[$choice->product_attr_id]['title'] = $choice->ProductAttr->title;
                        $choices[$choice->product_attr_id]['description'][] = $choice->description;
                    }
                }

                if ($item->size_id) {
                    $size = UnitColor::where('id', $item->size_id)->first()->name;
                }
            }

            foreach ($product as $prod) {
                $products[$key] = [
                    'nameProduct' => $prod->name,
                    'qyt' => $value->quantity,
                    'price' => $value->price,
                    'extra' => array_values($choices),
                    'size' => $size,

                ];
            }

        }


        $data = [];
        $data["info"] = $info;
        $data["products"] = $products;

        return ResponseJson('200', 'تفاصيل الطلب', $data);
    }

    //Create an offer from the order deliverer
    public function SendOfferDelivery(Request $request, $id)
    {

        $clientId = Auth::id();
        $driver = Car::where('client_id', $clientId)->first();

        if ($driver == null) {
            return ResponseJson('0', 'لا يوجد لك اى سيارة');
        }

        $drivers_requests = DriversRequests::where('car_id', $driver->id)->where('order_id', $id)->first();

        if (empty($drivers_requests)) {
            return ResponseJson('0', 'لا يوجد لك اى طلبات');
        }

        $order = Order::where('id', $drivers_requests->order_id)->first();


        if (empty($order)) {
            return ResponseJson('0', 'لا يوجد لك اى طلبات');
        }


        if ($order->car_id == 0) {

            $order->car_id = $driver->id;
            $order->status = 'padding';

            if ($order->save()) {

                $track = [
                    'order_id' => $order->id,
                    'time' => Carbon::now()->format('H:i:s'),
                    'status' => 'DriverDone',
                    'statusName' => 'تم موافقة السائق',
                ];
                DB::table('track_order')->insert($track);

                //delete Request
                DriversRequests::where('order_id', $id)->delete();

                // send notification store
                $store = Store::where('id', $order->store_id)->first();
                $client = Client::where('id', $store->client_id)->first();
                $notification = $client->notifications()->create([
                    'id' => Uuid::uuid4(),
                    'order_id' => $order->id,
                    'type' => 'store',
                    'title' => 'لديك طلب جديد',
                    'body' => 'لديك طلب من العميل' . ' ' . $order->name_buyer,
                ]);

                $tokens = $client->tokens()->where('token', '!=', '')->pluck('token')->toArray();

                if (count($tokens)) {
                    $title = $notification->title;
                    $body = $notification->body;
                    $data = [
                        'order_id' => $order->id
                    ];
                    $send = notifyByFirebase($title, $body, $tokens, $data);
                }

            }

        } else {
            return ResponseJson('0', 'عفوا لقد تم الموافقة على الطلب من سائق اخر', null);
        }


        //send notification
        $driver = Client::where('id', $order->car->client_id)->first();
        $client = Client::where('id', $order->client_id)->first();

        $notification = $client->notifications()->create([
            'id' => Uuid::uuid4(),
            'order_id' => '1',
            'type' => 'client',
            'title' => 'تمت موافقة السائق',
            'body' => 'بالموافقة على توصيل الطلب' . $driver->full_name . 'قام الكابتن',
        ]);

        $tokens = $client->tokens()->where('token', '!=', '')->pluck('token')->toArray();

        if (count($tokens)) {
            $title = $notification->title;
            $body = $notification->body;
            $data = [
                'order_id' => '1'
            ];
            $send = notifyByFirebase($title, $body, $tokens, $data);
        }

        return ResponseJson('200', 'شكرا لك يرجى الاتجاه الى المنشأه بعد استلام اشعار تجهيز الطلب', null);
    }

    protected function productsAreNoLongerAvailable($client)
    {
        $client = Client::where('id', $client)->first();
        $cart = Cart::where('client_id', $client->id)->get();
        foreach ($cart as $item) {
            $product = Product::find($item->product_id);
            if ($product->rest_quantity > $item->quantity) {
                return true;
            }
        }
        return false;
    }

    protected function NearbyCars($order_id, $lat, $long, $Car_type, $clientId, $addressId, $shipped)
    {
               $cars = Car::select(DB::raw('*, ( 6367 * acos( cos( radians(' . $lat . ') ) * cos( radians( late ) ) * cos( radians( lang ) - radians(' . $long . ') ) + sin( radians(' . $lat . ') ) * sin( radians( late ) ) ) ) AS distance'))
             ->where('Type_car', $Car_type)
          //  ->where('client_id', '!=', $clientId)
            ->where('status', 1)
            ->having('distance', '<', 50)
            ->orderBy('distance')
            ->get();

 

        if (count($cars) == 0) {
            return ResponseJson('0', 'نأسف لا يوجد أى مندوبين بالقرب منك حاليا يرجى المحاولة مرة أخرى');
        } else {
            foreach ($cars as $car) {
                DriversRequests::create([
                    'client_id' => $clientId,
                    'car_id' => $car->id,
                    'address_id' => $addressId,
                    'order_id' => $order_id,
                    'price' => $shipped
                ]);

                $car = Car::where('id', $car->id)->first();

                if ($car) {
                    
                $driver = Client::where('id', $car->client_id)->first();

                if ($driver) {
                  
                   //send notification to driver

                $notification = $driver->notifications()->create([
                    'id' => Uuid::uuid4(),
                    'order_id' => $order_id,
                    'type' => 'driver',
                    'title' => 'هناك طلب جديد',
                    'body' => 'لديك طلب جديد بالقرب منك',
                ]);

                $tokens = $driver->tokens()->where('token', '!=', '')->pluck('token')->toArray();
                if (count($tokens)) {
                    $title = $notification->title;
                    $body = $notification->body;
                    $data = [
                        'order_id' => $order_id
                    ];
                    $send = notifyByFirebase($title, $body, $tokens, $data);
                }
                    
                    
                  //  return ResponseJson('0', 'نأسف لك لدينا مشكله فى التواصل مع السائقين  يرجى المحاوله فى وقت اخر او ابلاغ الاداره :(');
                }
               
                    // return ResponseJson('0', ' :(نأسف لك لدينا مشكله فى التواصل  مع السياره يرجى المحاوله فى وقت اخر او ابلاغ الاداره');
                }

               
            }
        }
    }
}
