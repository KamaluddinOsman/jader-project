<?php

<<<<<<< HEAD
namespace App\Http\Controllers\Api\client;

use App\Client;
use App\Events\NewNotification;
use App\Http\Controllers\Controller;
use App\Car;
use App\MoneyAccount;
use App\Notification;
use App\Notifications\NewStoreNotification;
use App\Order;
use App\OrderItem;
use App\Product;
use App\RequestLog;
use App\Store;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Http\Resources\Store as StoreResource;
use Illuminate\Validation\Rule;
use Image;
use File;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return StoreResource
     */
    public function index()
    {
        $store = StoreResource::collection(Store::where('active', 1)->paginate(15));
        $count = count(Store::all());
        if ($count <= 0) {
            return ResponseJson('0', 'لا يوجد اى  مؤسسات ');
        } else {
            return ResponseJson('200', 'كل المؤسسات', $store);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        RequestLog::create(['content' => $request->all(), 'service' => 'create store']);

        $client = Auth::id();
        $store = Store::where('client_id', $client)->first();
        if (!empty($store)){
            return ResponseJson('0', 'لديك مؤسسة بالفعل',null);
        }

        $validator = validator()->make($request->all(), [
            'district_id' => 'required|int|exists:cities,id',
            'logo' => 'required|mimes:jpeg,jpg,png',
            'name' => 'required',
            'phone1' => 'required',
            'address' => 'required',
            'company_register' => 'required|int',
            'num_tax' => 'int',
            'name_responsible' => 'required',
            'responsible_position' => 'required',
            'responsible_mobile' => 'required',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
//            'day_work' => 'required',

        ]);

        if ($validator->fails()) {
            return ResponseJson('0', $validator->errors()->first(),null);
        }

        $store = new Store();
        $store->category_id = $request->category_id;
        $store->client_id = $client;
        $store->city_id = $request->district_id;
        $store->name = $request->name;
        $store->phone1 = $request->phone1;
        $store->phone2 = $request->phone2;
        $store->company_register = $request->company_register;
        $store->num_tax = $request->num_tax;
        $store->address = $request->address;
        $store->lang = $request->lang;
        $store->late = $request->late;
        $store->about = $request->about;
        $store->minimum_order = $request->minimum_order;
        $store->whatsapp = $request->whatsapp;
        $store->facebook = $request->facebook;
        $store->site = $request->site;

        $store->name_responsible = $request->name_responsible;
        $store->responsible_position = $request->responsible_position;
        $store->responsible_mobile = $request->responsible_mobile;
        $store->name_authorized = $request->name_authorized;
        $store->authorized_mobile = $request->authorized_mobile;
        $store->legal_name = $request->legal_name;
        $store->email = $request->email;

        $store->start_time = $request->start_time;
        $store->end_time = $request->end_time;
        $store->day_work = json_encode( $request->day_work);


        $store->active = 0;

        if($file = $request->file( 'logo')) {
            $store->logo = uploadImage($file,'store');
        }

         if($file = $request->file( 'picture_contract')) {
            $store->picture_contract = uploadImage($file,'store');
        }

        $store->save();

        // $admin = User::all();
        // \Illuminate\Support\Facades\Notification::send($admin, new NewStoreNotification($store));

        // $data = [
        //     'info'  => $store,
        //     'type'  => 'newStore'
        // ];
        // event(new NewNotification($data));

        $data = new StoreResource(Store::find($store->id));
        return ResponseJson('200', 'طلبك قيد الإنتظار سوف يتم الموافقة عليه فى أسرع وقت  :)', $data);

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $store = new StoreResource(Store::findOrFail($id));

        if ($store) {
            return ResponseJson('200', 'كل المؤسسات', $store);
        } else {
            return ResponseJson('0', 'لا يوجد اى  مؤسسات ');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @return Response
     */
    public function update(Request $request,$id)
    {
        RequestLog::create(['content' => $request->all(), 'service' => 'update store']);

        $validator = validator()->make($request->all(), [
            // 'district_id' => 'required|int|exists:cities,id',
            // 'logo' => 'required|mimes:jpeg,jpg,png',
            'name' => 'required',
            // 'phone1' => 'required|int',
            'address' => 'required',
            'company_register' => 'required|int',
            'num_tax' => 'int',
            'name_responsible' => 'required',
            'responsible_position' => 'required',
            'responsible_mobile' => 'required',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'day_work' => 'required',

        ]);
 
        if ($validator->fails()) {
            return ResponseJson('0', $validator->errors()->first(),null);
        }

        $store = Store::where('id',$id)->first();
        $client_id = $request->user()->id;
        if ($client_id == $store->client_id){
            $store->update($request->all());

            if($file = $request->file( 'logo')) {
                File::delete('storage/images/store/' . $store->logo);
                $store->logo = uploadImage($file,'store');
            }

            if($file = $request->file( 'picture_contract')) {
                File::delete('storage/images/store/' . $store->picture_contract);
                $store->picture_contract = uploadImage($file,'store');
            }

            $store->save();
            $data = new StoreResource(Store::find($store->id));
            return ResponseJson('200', 'تم التسجيل بنجاح', $data);
        }

        return ResponseJson('404', 'ليس ملك لك ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(Request $request,$id)
    {
        $store = Store::where('id',$id)->first();
        $client_id = $request->user()->id;
        if ($client_id == $store->client_id){
            $store->delete();
            return ResponseJson('200','تم حذف المؤسسة ');
        }
        return ResponseJson('404', 'ليس ملك لك ');
    }


    public function newOrder(){
        $client = Auth::id();
        $store = Store::where("client_id", $client)->pluck('id')->first();
        $order_items = OrderItem::with(['order.car.client','product'])->where("store_id", $store)->orderBy('id', 'desc')->get();

        if (count($order_items) == 0){
            return ResponseJson('200', 'لايوجد طلبات جديده');
        }

        $orders = [];

        foreach ($order_items as $item){

            $pending  = $item->where('order_id', $item->order_id)->where('status', 'pending')->where("store_id", $store)->count();
            $accept   = $item->where('order_id', $item->order_id)->where('status', 'accept')->where("store_id", $store)->count();
            $cancelled = $item->where('order_id', $item->order_id)->where('status', 'cancelled')->where("store_id", $store)->count();
            $complete = $item->where('order_id', $item->order_id)->where('status', 'complete')->where("store_id", $store)->count();

            if ($accept + $cancelled + $complete == count($order_items)){
                $stat = true;
            }else{
                $stat = false;
            }

            $orders[$item->order_id]['info'] = [
                "order_id"    =>    $item->order_id,
                "name_buyer"  =>    $item->order->name_buyer ?? '',
                "number_car"  =>    $item->order->car->number ?? '',
                "driver_name" =>    $item->order->car->client->full_name ?? '',
                "pending"     =>    $pending,
                "accept"      =>    $accept,
                "rejected"    =>    $cancelled,
                "complete"    =>    $complete,
                "status"      =>    $stat,
            ];

            $orders[$item->order_id]["products"][] = [
                "item_id"        => $item->id,
                "name"           => $item->product->name,
                "image"          => $item->product->image1,
                "price"          => $item->price,
                "discount"       => $item->discount,
                "quantity"       => $item->quantity,
                "status"         => $item->status,
            ];
        }

        $orders = array_values((array) $orders);
        return ResponseJson('200', 'طلباتك الجديدة', $orders);

    }

    public function updateStatusOrder(Request $request){

        RequestLog::create(['content' => $request->all(), 'service' => 'update Status Order']);

        $validator = validator()->make($request->all(), [
            'status' => 'required|in:cancelled,accept,complete',
        ]);

        if ($validator->fails()) {
            return ResponseJson('0', $validator->errors()->first(),  null);
        }
        $item = OrderItem::with('order')->where('id', $request->id)->first();
        $item->status = $request->status;
        $item->save();

        $store = Store::where('id', $item->store_id)->first();
        $car = Car::where('id', $item->order->car_id)->first();
        $driver = Client::where('id', $car->client_id)->first();
        $client = Client::where('id', $item->order->client_id)->first();
        $product = Product::where('id', $item->product_id)->first();

        if ($request->status == "cancelled"){

            $clientMoney = $item->price;

            $moneyAccount               = new MoneyAccount();
            $moneyAccount->order_id     = $item->order->id;
            $moneyAccount->user_id      = $item->order->client_id;
            $moneyAccount->total_money  = $item->price;
            $moneyAccount->client_money = $clientMoney;
            $moneyAccount->status       = 'bounced_back';
            $moneyAccount->note         = 'مرتجع الى المحفظة';
            $moneyAccount->save();

            if ($driver){
                //send notification to driver
                $notification =  $driver->notifications()->create([
                    'order_id' => $item->order->id,
                    'type'     => 'driver',
                    'title'    => 'تم الغاء هذا المنتج',
                    'body'     =>  $product->name . ' ' . 'بالغاء منتج ' . ' ' .$store->name . ' ' .'قامت مؤسسة'  ,
                ]);

                $tokens = $driver->tokens()->where('token','!=','')->pluck('token')->toArray();
                if (count($tokens)){
                    $title = $notification->title;
                    $body = $notification->body;
                    $data = [
                        'order_id'=>$item->order->id
                    ];
                    $send = notifyByFirebase($title,$body,$tokens,$data);
                };
            }


            if ($client){
                //send notification to client
                $notification =  $client->notifications()->create([
                    'order_id' => $item->order->id,
                    'type'     => 'driver',
                    'title'    => 'تم الغاء هذا المنتج',
                    'body'     =>  ' وسيتم اعادة المبلغ الى محفظتك '. $product->name . ' ' . 'بالغاء منتج ' . ' ' .$store->name . ' ' .'قامت مؤسسة'  ,
                ]);

                $tokens = $client->tokens()->where('token','!=','')->pluck('token')->toArray();
                if (count($tokens)){
                    $title = $notification->title;
                    $body = $notification->body;
                    $data = [
                        'order_id'=>$item->order->id
                    ];
                    $send = notifyByFirebase($title,$body,$tokens,$data);
                };
            }

            return ResponseJson('200','تم رفض هذا الطلب', $item);
        }elseif ($request->status == "accept"){

            if ($driver){
                //send notification to driver
                $notification =  $driver->notifications()->create([
                    'order_id' => $item->order->id,
                    'type'     => 'driver',
                    'title'    => 'تم الموافقة هذا المنتج',
                    'body'     =>  $product->name . ' ' . 'بالموافقة على المنتج ' . ' ' .$store->name . ' ' .'قامت مؤسسة'  ,
                ]);

                $tokens = $driver->tokens()->where('token','!=','')->pluck('token')->toArray();
                if (count($tokens)){
                    $title = $notification->title;
                    $body = $notification->body;
                    $data = [
                        'order_id'=>$item->order->id
                    ];
                    $send = notifyByFirebase($title,$body,$tokens,$data);
                };
            }

            if ($client){
                //send notification to client
                $notification =  $client->notifications()->create([
                    'order_id' => $item->order->id,
                    'type'     => 'client',
                    'title'    => 'تم الموافقة على هذا المنتج',
                    'body'     =>  $product->name . ' ' . 'بالموافقة على منتج ' . ' ' .$store->name . ' ' .'قامت مؤسسة'  ,
                ]);

                $tokens = $client->tokens()->where('token','!=','')->pluck('token')->toArray();
                if (count($tokens)){
                    $title = $notification->title;
                    $body = $notification->body;
                    $data = [
                        'order_id'=>$item->order->id
                    ];
                    $send = notifyByFirebase($title,$body,$tokens,$data);
                };
            }

            return ResponseJson('200','تم الموافقه على هذا الطلب', $item);
        }else{

            if ($driver){
                $All_items_complete = OrderItem::where('order_id', $item->order->id)->where('store_id', $item->store_id)->where('status', 'complete')->get();
                $All_items_cancelled = OrderItem::where('order_id', $item->order->id)->where('store_id', $item->store_id)->where('status', 'cancelled')->get();
                $All_items = OrderItem::where('order_id', $item->order->id)->where('store_id', $item->store_id)->get();
                $allMoneyOrder = $All_items_complete->Sum('price');

                if (count($All_items_complete) + count($All_items_cancelled) == count($All_items)){

                    $siteMoney  = settings()->commission *  $allMoneyOrder / 100;

                    $clientMoney = $allMoneyOrder - $siteMoney;

                    $moneyAccount               = new MoneyAccount();
                    $moneyAccount->order_id     = $item->order->id;
                    $moneyAccount->store_id     = $item->store_id;
                    $moneyAccount->total_money  = $allMoneyOrder;
                    $moneyAccount->site_money   = $siteMoney;
                    $moneyAccount->client_money = $clientMoney;
                    $moneyAccount->status       = 'commission';
                    $moneyAccount->note         = 'نسبة المؤسسة';
                    $moneyAccount->save();
                }

                //send notification to driver
                $notification =  $driver->notifications()->create([
                    'order_id' => $item->order->id,
                    'type'     => 'driver',
                    'title'    => 'تم الانتهاء هذا المنتج',
                    'body'     =>  $product->name . ' ' . 'بالانتهاء من هذا المنتج ' . ' ' .$store->name . ' ' .'قامت مؤسسة'  ,
                ]);

                $tokens = $driver->tokens()->where('token','!=','')->pluck('token')->toArray();
                if (count($tokens)){
                    $title = $notification->title;
                    $body = $notification->body;
                    $data = [
                        'order_id'=>$item->order->id
                    ];
                    $send = notifyByFirebase($title,$body,$tokens,$data);
                };
            }

            return ResponseJson('200','تم الانتهاء من هذا الطلب', null);
        }
    }

    public function commissions(Request $request)
    {
        $to = $request->to;
        $from = $request->from;
        $client = Auth::id();
        $store = Store::where('client_id', $client)->first();

        if (!$store){
            return ResponseJson('0', 'لايوجد لك مؤسسة');
        }

        $money = MoneyAccount::where('store_id', $store->id);

//        if ($to && $from){$money->whereBetween('created_at', [$from, $to]);}

        $money = $money->get();

        if (count($money) == 0){
            return ResponseJson('200', 'لا يوجد لك اى تعاملات مالية :( ', null);
        }


        $cash_withdrawal = $money->where('status', 'remittance')->sum('client_money');


        $total = $money->where('status', 'commission')->sum('total_money');  //كل المبيعات

        $profit_site = $money->where('status', 'commission')->sum('site_money'); //ارباح الموقع

        $profit_store = $money->where('status', 'commission')->sum('client_money'); //ارباح المؤسسة

        $cash_withdrawal = $cash_withdrawal;  //التحويل النقدي للمؤسسة

        $net_commissions = $money->sum('client_money') - $cash_withdrawal;  // المتبقى

        $commission = settings()->commission; //نسبة اللطبيق



        $OrderItem = OrderItem::with('product')->where('store_id', $store->id)->groupBy('product_id');

//        if ($to && $from){
//            $OrderItem->whereBetween('created_at', [$from, $to]);
//        }

        $items_complete  = $OrderItem->where('status', 'complete')->get();

        $items_cancelled  = $OrderItem->where('status', 'cancelled')->get();


        $data =[];
        $data['info'] = [
            'total'           => number_format((float)$total, 2, '.', ''),
            'profit_site'     => number_format((float)$profit_site, 2, '.', ''),
            'profit_store'    => number_format((float)$profit_store, 2, '.', ''),
            'cash_withdrawal' => number_format((float)$cash_withdrawal, 2, '.', ''),
            'net_commissions' => number_format((float)$net_commissions, 2, '.', ''),
            'commission'      => $commission
        ];


        foreach ($items_complete as $item){
            $data['item_complete'][] = [
               'item_name'   => $item->product->name,
               'quantity'    =>  $item->where('product_id', $item->product->id)->sum('quantity'),
               'total_price' =>  $item->where('product_id', $item->product->id)->sum('price'),
            ];
        }

        foreach ($items_cancelled as $item){
            $data['item_cancelled'][] = [
                'item_name'   => $item->product->name,
                'quantity'    =>  $item->where('product_id', $item->product->id)->sum('quantity'),
                'total_price' =>  $item->where('product_id', $item->product->id)->sum('price'),
            ];
        }

        return ResponseJson('200', 'تقارير المبيعات', $data);

    }

}

?>
=======
namespace App\Http\Resources;

use App\District;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\District as DistrictResource;
use Illuminate\Http\Resources\Json\Resource;

class Store extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'client_id' => $this->client_id,
            'category_id' => $this->category_id,
            'city_id' => $this->city_id,
            'logo' => $this->logo,
            'name' => $this->name,
            'phone1' => $this->phone1,
            'phone2' => $this->phone2,
            'company_register' => $this->company_register,
            'num_tax' => $this->num_tax,
            'address' => $this->address,
            'lang' => $this->lang,
            'late' => $this->late,
            'about' => $this->about,
            'minimum_order' => $this->minimum_order,
            'delivery_price' => $this->delivery_price,
            'whatsapp' => $this->whatsapp,
            'facebook' => $this->facebook,
            'site' => $this->site,
            'status' => $this->status,
            'active' => $this->active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'city' => new DistrictResource($this->district),
            'client' => $this->client,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'day_work' => json_decode($this->day_work),
            'name_responsible' => $this->name_responsible,
            'responsible_position' => $this->responsible_position,
            'responsible_mobile' => $this->responsible_mobile,
            'name_authorized' => $this->name_authorized,
            'authorized_mobile' => $this->authorized_mobile,
            'legal_name' => $this->legal_name,
            'ipan' => $this->ipan,
            'name_card' => $this->name_card,
            'bank_name' => $this->bank_name,
            'order_processing_time' => $this->order_processing_time,
            'ratio' => $this->ratio,
        ];
    }
}
>>>>>>> cfbcdca087ac8e3d769362633daf31d7dedf7b0e
