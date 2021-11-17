<?php

namespace App\Http\Controllers\Api\client;

use App\Car;
use App\Client;
use App\DriversRequests;
use App\ExtraProduct;
use App\MoneyAccount;
use App\Order;
use App\OrderItem;
use App\ProductAttrItem;
use App\Address;
use App\RequestLog;
use App\Store;
use App\UnitColor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Ramsey\Uuid\Uuid;

class ClientController extends Controller
{

    public function AllOrderClient(Request $request)
    {
        $client = Auth::id();
        $listOrders = Order::with('items.product', 'store')->where('client_id', $client)->where('status', '!=', 'new')->get();

        if (count($listOrders) == 0) {
            return ResponseJson('200', 'لايوجد طلبات ');
        }

        $extra = '';
        $remove = '';
        $size = '';

        $orders = [];
        foreach ($listOrders as $order) {

//            $order_items = OrderItem::where("order_id", $order->id)->count();
            $pending = OrderItem::where('status', 'pending')->where("order_id", $order->id)->count();
            $accept = OrderItem::where('status', 'accept')->where("order_id", $order->id)->count();
            $rejected = OrderItem::where('status', 'cancelled')->where("order_id", $order->id)->count();
            $complete = OrderItem::where('status', 'complete')->where("order_id", $order->id)->count();
            $ordeer = Order::where('id', $order->id)->where('status', 'Delivered')->first();

            $car = Car::where('id', $order->car_id)->first();
            $store = Store::where('id', $order->store_id)->first();

            //client
            $langFromClient = (float)$order->address->lang;
            $lateFromClient = (float)$order->address->late;

            //store
            $langFromStore = (float)$store->lang;
            $lateFromStore = (float)$store->late;


            if ($ordeer) {
                $stat = true;
            } 
            else {
                $stat = false;
            }
         
            if ($order->car_id == 0) {
                $number = 'لايوجد حتى الان';
                $driver_name = 'لايوجد حتى الان';
                $phone = 'لايوجد حتى الان';
                $image = 'لايوجد حتى الان';
                $langFromDriver = '';
                $lateFromDriver = '';
            }
            else {
                $number = $order->car->number. '-' .$order->car->char_car;
                $driver_name = $order->car->client->full_name;
                $phone = $order->car->client->phone;
                $image = $order->car->image_car_front;
                $langFromDriver = (float)$car->lang;
                $lateFromDriver = (float)$car->late;
            }
        
            $orders[$order->id]['info'] = [
                "order_id" => $order->id,
                "billing_total" => $order->billing_total,
                "shipped" => $order->shipped,
                "billing_tax" => $order->billing_tax,
                "store_logo" => $order->store->logo,
                "store_name" => $order->store->name,
                "driver_phone" => $phone,
                "driver_name" => $driver_name,
                "number_car" => $number,
                "image_car" => $image,
                "pending" => $pending,
                "accept" => $accept,
                "rejected" => $rejected,
                "complete" => $complete,
                "status" => $stat,

                "driverYes" => $car ? 'true' : 'false',
                "orderStatues" => $order->status,
                "payment" => $order->payment,
                "delivery_limit" => $order->store->deliveryLimit,

                "langClient" => $langFromClient,
                "latClient" => $lateFromClient,
                "lateStore" => $lateFromStore,
                "langStore" => $langFromStore,
                "langDriver" => $langFromDriver,
                "latDriver" => $lateFromDriver,

                "track" => DB::table("track_order")->where('order_id', $order->id)->get()
            ];

            foreach ($order->items as $item) {

                if ($item->store == null) {
                    return ResponseJson('0', 'نأسف لك حدث مشكله لدى منشأة تم الطلب منها من قبل يرجى التواصل مع الادارة', null);
                }


                if ($item->extra_product) {
                    foreach (json_decode($item->extra_product) as $k => $item_extra) {
                        $extra_product[$k] = ExtraProduct::where('id', $item_extra)->first()->name;

                    }
                    $extra = implode(" , ", $extra_product);
                }

                if ($item->remove_product) {
                    foreach (json_decode($item->remove_product) as $r => $item_remove) {
                        $remove_product[$r] = ExtraProduct::where('id', $item_remove)->first()->name;
                    }

                    $remove = implode(" , ", $remove_product);
                }
                
 
                $orders[$order->id]["products"][] = [
                    "item_id" => $item->id,
                    "store_name" => $item->store->name,
                    "name" => $item->product->name,
                    "image" => $item->product->image1,
                    "price" => $item->price,
                    "discount" => $item->discount,
                    "quantity" => $item->quantity,
                    "status" => $item->status,
                    'extra' => $extra,
                    'remove' => $remove,
                    'size' => $size,
                ];
            }
        }

        $orders = array_values((array)$orders);
        return ResponseJson('200', 'طلباتك', $orders);

    }

    public function AllOrderDriver(Request $request)
    {
        $client = Auth::id();
        $car = Car::where('client_id', $client)->first();

        $extra = '';
        $remove = '';
        $size = '';

        $orderId = $request->order_id;

        if (!empty($car)) {
            if (!empty($orderId)){
                $listOrders = Order::with('items.product') ->where('car_id', $car->id)->where('id', $orderId)->get();
            }else{

                if ($request->status == 'padding'){
                    $listOrders = Order::with('items.product')->where('car_id', $car->id) ->get();
                  //  ->orwhere('status', '=', 'padding')->orwhere('status', '==', 'Delivered')->orwhere('status', '=', 'accept')

                }elseif ($request->status == 'delivered'){
                    $listOrders = Order::with('items.product')->where('status', '==', 'Delivered')->where('car_id', $car->id)->get();
                }
            }

            if (count($listOrders) == 0) {
                return ResponseJson('0', 'لايوجد طلبات ');
            }

            foreach ($listOrders as $order) {
                $order_items = OrderItem::where("order_id", $order->id)->count();

                if ($order_items == 0) {
                    return ResponseJson('0', 'لايوجد طلبات ');
                }

                $products = [];

                foreach ($order->items as $item) {

                    $order = Order::with('store', 'address')->where('id', $item->order_id)->first();


                    //client
                    $langFromClient = (float)$order->address->lang;
                    $lateFromClient = (float)$order->address->late;
                    $to_latlong = $lateFromClient . ',' . $langFromClient;


                    //store
                    $langFromStore = (float)$order->store->lang;
                    $lateFromStore = (float)$order->store->late;
                    $dests = $lateFromStore . ',' . $langFromStore;

                    $distanceBetweenStoreClient = getMoreDistance($dests, $to_latlong, true, true);


                    //Driver
                    $langFromDriver = (float)$car->lang;
                    $lateFromDriver = (float)$car->late;
                    $Driverdests = $lateFromDriver . ',' . $langFromDriver;
                    $distanceBetweenStoreDriver = getMoreDistance($Driverdests, $dests, true, true);


                    $statusDelivery = DB::table('track_order')->where('order_id', $order->id)->orderBy('id', 'desc')->first();

                    $choices = [];
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

                    if (!empty($orderId)) {
                        $products[] = [
                            "item_id" => $item->id,
                            "product_id" => $item->product->id,
                            "name" => $item->product->name,
                            "image" => $item->product->image1,
                            "price" => $item->price,
                            "discount" => $item->discount,
                            "quantity" => $item->quantity,
                            "status" => $item->status,
                            "attr" => array_values($choices) ?? '',
                            'size' => $size,
                        ];
                    }

                    $stores = [
                        "store_id" => $item->store->id,
                        "store_logo" => $item->store->logo,
                        "store_name" => $item->store->name ?? "",
                        "store_lang" => $item->store->lang,
                        "store_late" => $item->store->late,

                        "durationBetweenStoreClient" => $distanceBetweenStoreClient['duration'],
                        "distanceBetweenStoreClient" => (int)round($distanceBetweenStoreClient['distance']),
                        "langClient" => $langFromClient,
                        "latClient" => $lateFromClient,
                        "durationBetweenStoreDriver" => $distanceBetweenStoreDriver['duration'],
                        "distanceBetweenStoreDriver" => (int)round($distanceBetweenStoreDriver['distance']),
                        "langDriver" => $langFromDriver,
                        "latDriver" => $lateFromDriver,

                        "products" => array_values($products),
                    ];
                }


                if (!empty($order->address())) {
                    $orders[$order->id]['info'] = [
                        "order_id" => $order->id,
                        "payment" => $order->payment,
                        "status_order" => $order->status,
                        "billing_total" => $order->billing_total,
                        "shipped" => $order->shipped,
                        "billing_tax" => $order->billing_tax,
                        "name_buyer" => $order->name_buyer,
                        "buyer_lang" => $order->address->lang,
                        "buyer_late" => $order->address->late,
                        "address" => $order->billing_address,
                        "billing_phone" => $order->billing_phone,
                         "created_at" => $order->created_at,
                        "statusDelivery" => $statusDelivery->status ?? '',
                        "stores" => $stores,
                    
                    ];

                }

            }

            $orders = array_values((array)$orders);
            return ResponseJson('200', 'طلباتك', $orders);
        } else {
            return ResponseJson('0', 'ليس لديك سيارة', null);
        }

    }


    public function commissions(Request $request)
    {
        $client = Auth::id();

        $money = MoneyAccount::where('client_id', $client)->get();

        if (count($money) == 0) {
            return ResponseJson('200', 'لا يوجد لك اى تعاملات مالية :( ', null);
        }


        $profit_client = $money->sum('client_money'); //ارباح المؤسسة

        return ResponseJson('200', 'محفظتك', $profit_client);
    }
    
    
    
 public function destroyOrder(Request $request)
    {


        $orderRequest = DriversRequests::where('order_id', $request->orderId)->get();
         $current = Auth::id();
    
        $client = Client::where('id', $current)->first();
        //  return $client;
      
  
        if ($orderRequest){
          foreach ($orderRequest as $item) {
         $item->delete();
        }
        
        Order::where('id',$request->orderId)->update(['status' => 'cancel']);
        
         //send notification to client
                $notification = $client->notifications()->create([
                    'id' => Uuid::uuid4(),
                    'order_id' => $request->orderId,
                    'type' => 'client',
                    'title' => 'تم الغاء هذا المنتج',
                    'body' => ' بإلغاء الطلب وسيتم اعادة المبلغ الى المحفظة. قامت ',
                ]);
                
                
                 $tokens = $client->tokens()->where('token', '!=', '')->pluck('token')->toArray();
                 
                 return $tokens;
                if (count($tokens)) {
                    $title = $notification->title;
                    $body = $notification->body;
                    $data = [
                        'order_id' => $request->orderId,
                    ];
                    $send = notifyByFirebase($title, $body, $tokens, $data);
                }
        
        
            return ResponseJson('200','تم الغاء  الطب  ');
        }else{
            return ResponseJson('0','توجد مشكلة في الطلب  ');
        }
    }
    
    
    
    
    public function destroyAddress(Request $request)
    {
        
         $client = Auth::id();
    

        try {
            $address = Address::where('id', $request->id)->first();
           $address ->delete();
          
            if (!$address) {
                
        
                 return ResponseJson('0', 'addess  is not found ');
            }
            $address->delete();

           return ResponseJson('200', 'تم حذف الموقع');

        } catch (\Exception $ex) {
            
          return ResponseJson('0', $ex);
        }
    }

}
