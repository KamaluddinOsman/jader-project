<?php

namespace App\Http\Controllers\Api\client;

use App\Address;
use App\Client;
use App\Events\NewNotification;
use App\ExtraProduct;
use App\Http\Controllers\Controller;
use App\Car;
use App\MoneyAccount;
use App\Notifications\NewStoreNotification;
use App\Order;
use App\OrderItem;
use App\Product;
use App\ProductAttrItem;
use App\RequestLog;
use App\Store;
use App\UnitColor;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\Store as StoreResource;
use Image;
use File;
use Ramsey\Uuid\Uuid;

class StoreController extends Controller
{
    public function index(Request $request)
    {
        $address = Address::where('id', $request->address_id)->first();

        if (!$address) {
            return ResponseJson('0', 'يرجى التأكد من العنوان ');
        }

        $store = Store::select(DB::raw('*, ( 6367 * acos( cos( radians(' . $address->late . ') ) * cos( radians( late ) ) * cos( radians( lang ) - radians(' . $address->lang . ') ) + sin( radians(' . $address->late . ') ) * sin( radians( late ) ) ) ) AS distance'))
            ->with('client', 'category', 'categories', 'spacialCategory')
            ->where('active', 1)
            ->having('distance', '<', 30)
            ->orderBy('distance');

        if ($request->categoryId) {
            $store = $store->where('category_id', $request->categoryId);
        }

        if ($request->sub_category) {
            $store = $store->whereHas('categories', function ($q) use ($request) {
                $q->where('id', '=', $request->sub_category);
            });
        }

       if ($request->search) {
            $store = $store->where('name', 'like', "%$request->search%");
        }
        
        
        $store = $store->get();

        $count = Count($store);
        if ($count <= 0) {
            return ResponseJson('0', 'لا يوجد اى  مؤسسات ', null);
        } else {
            return ResponseJson('200', 'كل المؤسسات', $store);
        }
    }

    public function store(Request $request)
    {
        RequestLog::create(['content' => $request->all(), 'service' => 'create store']);

        $client = Auth::id();
        $store = Store::where('client_id', $client)->first();
        if (!empty($store)) {
            return ResponseJson('0', 'لديك مؤسسة بالفعل', null);
        }

        $validator = validator()->make($request->all(), [
            'city_id' => 'int|exists:cities,id',
            'logo' => 'required|mimes:jpeg,jpg,png',
            'cover' => 'required|mimes:jpeg,jpg,png',
            'front_img' => 'required|mimes:jpeg,jpg,png',
            'name' => 'required',
            'phone1' => 'required',
            'address' => 'required',
            'company_register' => 'required|int',
            'num_tax' => 'int',
            'name_responsible' => 'required',
            'responsible_position' => 'required',
            'responsible_mobile' => 'required',
            'name_card' => 'required',
            'ipan' => 'required|unique:stores,ipan',
            'bank_name' => 'required',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
//            'day_work' => 'required',

        ]);

        if ($validator->fails()) {
            return ResponseJson('0', $validator->errors()->first(), null);
        }

        $dayWeek = ['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];

        if ($request->day_work) {
            $day_work = json_encode($request->day_work);
        } else {
            $day_work = json_encode($dayWeek);
        }

        $store = new Store();
        $store->category_id = $request->category_id;
        $store->client_id = $client;
        $store->city_id = $request->city_id;
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

        $store->delivery_price = $request->delivery_price;
        $store->delivery_service = $request->delivery_service;
        $store->delivery_limit = $request->delivery_limit;

        $store->name_responsible = $request->name_responsible;
        $store->responsible_position = $request->responsible_position;
        $store->responsible_mobile = $request->responsible_mobile;
        $store->name_authorized = $request->name_authorized;
        $store->authorized_mobile = $request->authorized_mobile;
        $store->legal_name = $request->legal_name;
        $store->email = $request->email;

        $store->start_time = $request->start_time;
        $store->end_time = $request->end_time;
        $store->day_work = $day_work;
        $store->name_card = $request->name_card;
        $store->ipan = $request->ipan;
        $store->bank_name = $request->bank_name;
        $store->about = $request->about;
        $store->order_processing_time = $request->order_processing_time;

        $store->active = 0;

        if ($file = $request->file('logo')) {
            $store->logo = uploadImage($file, 'store');
        }

        if ($file = $request->file('cover')) {
            $store->cover = uploadImage($file, 'store');
        }

        if ($file = $request->file('picture_contract')) {
            $store->picture_contract = uploadImage($file, 'store');
        }

        if ($file = $request->file('front_img')) {
            $store->front_img = uploadImage($file, 'store');
        }

        $store->save();


        $store->categories()->attach($request->cate);

        $admin = User::all();
        \Illuminate\Support\Facades\Notification::send($admin, new NewStoreNotification($store));

        $data = [
            'info' => $store,
            'type' => 'newStore'
        ];
        event(new NewNotification($data));

        $data = new StoreResource(Store::find($store->id));
        return ResponseJson('200', 'طلبك قيد الإنتظار سوف يتم الموافقة عليه فى أسرع وقت  :)', $data);

    }

    public function show(Request $request, $id)
    {
        $store = Store::with('client', 'category', 'categories', 'spacialCategory')->where('id', $id)->first();

        if (empty($store)) {
            return ResponseJson('0', 'لا يوجد هذه المؤسسة ');
        }


        if ($request->address_id && $request->type_car) {
            $store->details = $store->Distance($request->address_id, $request->type_car);

            $store->day_work = (json_decode($store->day_work));

            if ($store) {
                return ResponseJson('200', 'المؤسسة ', $store);
            } else {
                return ResponseJson('0', 'لا يوجد اى  مؤسسات ', null);
            }
        } else {
            $store->day_work = (json_decode($store->day_work));

            if ($store) {
                return ResponseJson('200', 'المنشأه', $store);
            } else {
                return ResponseJson('0', 'لا يوجد اى  مؤسسات ', null);
            }
        }
    }

    public function profileStore()
    {
        $id = Auth::id();
        $store = Store::with('categories')->where('client_id', $id)->first();
        $store->day_work = (json_decode($store->day_work));

        if ($store) {
            return ResponseJson('200', 'المنشأه الخاصة بك', $store);
        } else {
            return ResponseJson('0', 'لا يوجد اى  مؤسسات ', null);
        }
    }

    public function update(Request $request, $id)
    {

        RequestLog::create(['content' => $request->all(), 'service' => 'update store']);

        $validator = validator()->make($request->all(), [
            // 'city_id' => 'int|exists:cities,id',
            'logo' => 'mimes:jpeg,jpg,png',
            'cover' => 'mimes:jpeg,jpg,png',
            'name' => 'required',
            // 'phone1' => 'required',
            'address' => 'required',
            'company_register' => 'required|int',
            'num_tax' => 'int',
            'name_responsible' => 'required',
            'responsible_position' => 'required',
            'responsible_mobile' => 'required',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'name_card' => 'required',
            'ipan' => 'required|unique:stores,ipan,' . $id,
            'bank_name' => 'required',
        ]);

        if ($validator->fails()) {
            return ResponseJson('0', $validator->errors()->first(), null);
        }

        $store = Store::where('id', $id)->first();
        $client_id = $request->user()->id;



        $request->merge([
            'day_work' => json_encode($request->day_work),
        ]);

        if ($client_id == $store->client_id) {
            $store->update($request->all());

            if ($file = $request->file('logo')) {
                File::delete('storage/images/store/' . $store->logo);
                $store->logo = uploadImage($file, 'store');
            }

            if ($file = $request->file('cover')) {
                File::delete('storage/images/store/' . $store->cover);
                $store->cover = uploadImage($file, 'store');
            }

            if ($file = $request->file('picture_contract')) {
                File::delete('storage/images/store/' . $store->picture_contract);
                $store->picture_contract = uploadImage($file, 'store');
            }

            if ($file = $request->file('front_img')) {
                $store->front_img = uploadImage($file, 'store');
            }

            $store->save();

            $store->categories()->sync(json_decode($request->cate));

            $data = new StoreResource(Store::find($store->id));
            return ResponseJson('200', 'تم التحديث بنجاح', $data);
        }

        return ResponseJson('404', 'ليس ملك لك ');
    }

    public function updateStausStore(Request $request)
    {
        $client = Auth::id();
        $store = Store::where('client_id', $client)->first();

        if (!$store) {
            return ResponseJson('0', 'لا يوجد لك مؤسسة');
        } else {

            if ($request->status == 0) {
                $status = 'close';
            } elseif ($request->status == 1) {
                $status = 'open';
            } else {
                $status = 'busy';
            }
            $store->status = $status;
            $store->save();
            if ($store->status == 0) {
                return ResponseJson('200', 'تم إغلاق المنشأه بنجاح', null);
            } elseif ($store->status == 1) {
                return ResponseJson('200', 'تم تشغيل المنشأه بنجاح', null);
            } elseif ($store->status == 2) {
                return ResponseJson('200', 'تم تعديل المنشأه  الى غير متاح بنجاح', null);
            } else {
                return ResponseJson('200', 'اى الحالة دى', null);
            }

        }
    }

    public function destroy(Request $request, $id)
    {
        $store = Store::where('id', $id)->first();
        $client_id = $request->user()->id;
        if ($client_id == $store->client_id) {
            $store->delete();
            return ResponseJson('200', 'تم حذف المؤسسة ');
        }
        return ResponseJson('404', 'ليس ملك لك ');
    }

    public function countOrderStatus(){

        $client = Auth::id();
        $store = Store::where("client_id", $client)->pluck('id')->first();
        $order = Order::where("store_id", $store)->get();
        $new = $order->where('status', 'padding')->where('car_id', '!=', '0')->count();
        $accept = $order->where('status', 'accept')->where('car_id', '!=', '0')->count();
        $cancelled = $order->where('status', 'cancel')->count();
        $complete = $order->where('status', 'Delivered')->count();

        $data = [
            "new"      => $new,
            "accept"   => $accept,
            "rejected" => $cancelled,
            "complete" => $complete,
            "countAll" => $new + $cancelled + $complete,
        ];

        return ResponseJson('200', 'كل الطلبات', $data);

    }

    public function newOrder()
    {
        $client = Auth::id();
        $store = Store::where("client_id", $client)->pluck('id')->first();
        $order = OrderItem::with(['order.car.client', 'product'])->where("store_id", $store)->whereHas('order', function ($query) {
            return $query->where('status', '!=', 'unpaid')->where('status', '!=', 'new');
        })->orderBy('id', 'desc')->get();



        if (count($order) == 0) {
            return ResponseJson('200', 'لايوجد طلبات جديده');
        }

        $orders = [];

        foreach ($order as $item) {

            $choices = [];
            if ($item->product_attr) {
                $ids = json_decode(json_decode($item->product_attr));
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

            $numberCar = $item->order->car->number ?? '';
            $charCar = $item->order->car->number ?? '';

            $orders[$item->order_id]['info'] = [
                "order_id" => $item->order_id,
                "order_created_date" => $item->order->created_at->format('Y-m-d h:i'),
                "name_buyer" => $item->order->name_buyer ?? '',
                "billing_total" => $item->order->billing_total ?? '',
                "number_car" => $numberCar . '-' . $charCar ?? '',
                "driver_name" => $item->order->car->client->full_name ?? '',
                "payment" => $item->order->payment ?? '',
                "pending" => 0,
                "accept" => 0,
                "rejected" => 0,
                "complete" => 0,
                "status" => $item->order->status,
            ];

            $orders[$item->order_id]["products"][] = [
                "item_id" => $item->id,
                "name" => $item->product->name,
                "image" => $item->product->image1,
                "price" => $item->price,
                "discount" => $item->discount,
                "quantity" => $item->quantity,
                "attr" => array_values($choices) ?? '',
                "size" => $size ?? '',
            ];
        }

        $orders = array_values((array)$orders);
        return ResponseJson('200', 'طلباتك الجديدة', $orders);

    }

    public function updateStatusOrder(Request $request)
    {

        // RequestLog::create(['content' => $request->all(), 'service' => 'update Status Order']);

        $validator = validator()->make($request->all(), [
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return ResponseJson('0', $validator->errors()->first(), null);
        }


        $order = Order::where('id', $request->id)->first();

        if($order == null){
            return ResponseJson('0', 'لا يوجد هذا الطلب', null);
        }

        $order->status = $request->status;
        $order->save();


        $store = Store::where('id', $order->store_id)->first();
        $car = Car::where('id', $order->car_id)->first();
        $driver = Client::where('id', $car->client_id)->first();
        $client = Client::where('id', $order->client_id)->first();


        if ($request->status == "cancel") {

            $clientMoney = $order->billing_total;

            $moneyAccount = new MoneyAccount();
            $moneyAccount->order_id = $order->id;
            $moneyAccount->client_id = $order->client_id;
            $moneyAccount->total_money = $order->billing_total;
            $moneyAccount->client_money = $clientMoney;
            $moneyAccount->status = 'bounced_back';
            $moneyAccount->note = 'مرتجع الى المحفظة';
            $moneyAccount->save();

            if ($driver) {
                //send notification to driver
                $notification = $driver->notifications()->create([
                    'id' => Uuid::uuid4(),
                    'order_id' => $order->id,
                    'type' => 'driver',
                    'title' => 'تم الغاء هذا الطلب',
                    'body' =>'بالغاء الطلب ' . ' ' . $store->name . ' ' . 'قامت مؤسسة',
                ]);

                $tokens = $driver->tokens()->where('token', '!=', '')->pluck('token')->toArray();
                if (count($tokens)) {
                    $title = $notification->title;
                    $body = $notification->body;
                    $data = [
                        'order_id' => $order->id
                    ];
                    $send = notifyByFirebase($title, $body, $tokens, $data);
                }
            }


            if ($client) {
                //send notification to client
                $notification = $client->notifications()->create([
                    'id' => Uuid::uuid4(),
                    'order_id' => $order->id,
                    'type' => 'driver',
                    'title' => 'تم الغاء هذا المنتج',
                    'body' => ' بإلغاء الطلب وسيتم اعادة المبلغ الى المحفظة ' . ' ' . $store->name . ' ' . 'قامت مؤسسة',
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

            return ResponseJson('200', 'تم رفض هذا الطلب', $order);

        } elseif ($request->status == "accept") {

            if ($driver) {
                //send notification to driver
                $notification = $driver->notifications()->create([
                    'id' => Uuid::uuid4(),
                    'order_id' => $order->id,
                    'type' => 'driver',
                    'title' => 'تم الموافقة هذا الطلب',
                    'body' =>  'بالموافقة على الطلب ' . ' ' . $store->name . ' ' . 'قامت مؤسسة',
                ]);

                $tokens = $driver->tokens()->where('token', '!=', '')->pluck('token')->toArray();
                if (count($tokens)) {
                    $title = $notification->title;
                    $body = $notification->body;
                    $data = [
                        'order_id' => $order->id
                    ];
                    $send = notifyByFirebase($title, $body, $tokens, $data);
                }
            }

            if ($client) {
                //send notification to client
                $notification = $client->notifications()->create([
                    'id' => Uuid::uuid4(),
                    'order_id' => $order->id,
                    'type' => 'client',
                    'title' => 'تم الموافقة على هذا الطلب',
                    'body' => 'بالموافقة على الطلب ' . ' ' . $store->name . ' ' . 'قامت مؤسسة',
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

            $statusTrack = DB::table('track_order')->where('order_id', $order->id)->where('status', 'StoreDone')->first();

            $track = [
                'order_id' => $order->id,
                'time' => Carbon::now()->format('H:i:s'),
                'status' => 'StoreDone',
                'statusName' => 'جارى تجهيز الطلب',
            ];

            if (!$statusTrack) {
                DB::table('track_order')->insert($track);
            }

            return ResponseJson('200', 'تم الموافقه على هذا الطلب', $order);
        } else {
            if ($driver) {


                $siteMoney = settings()->commission * $order->billing_total / 100;

                $moneyAccount = new MoneyAccount();
                $moneyAccount->order_id = $order->id;
                $moneyAccount->store_id = $order->store_id;
                $moneyAccount->total_money = $order->billing_total;

                if ($order->payment == 'cash'){
                    $clientMoney = -$siteMoney;
                    $moneyAccount->note = 'تم الدفع كاش من العميل';


                }else{
                    $clientMoney = $order->billing_total - $siteMoney;
                    $moneyAccount->note = 'نسبة المؤسسة';

                }


                $moneyAccount->site_money = $siteMoney;
                $moneyAccount->client_money = $clientMoney;
                $moneyAccount->status = 'commission';
                $moneyAccount->save();
            }

            //send notification to driver
            $notification = $driver->notifications()->create([
                'id' => Uuid::uuid4(),
                'order_id' => $order->id,
                'type' => 'driver',
                'title' => 'تم الانتهاء هذا المنتج',
                'body' =>  'بالانتهاء من هذا الطلب ' . ' ' . $store->name . ' ' . 'قامت مؤسسة',
            ]);

            $tokens = $driver->tokens()->where('token', '!=', '')->pluck('token')->toArray();
            if (count($tokens)) {
                $title = $notification->title;
                $body = $notification->body;
                $data = [
                    'order_id' => $order->id
                ];
                $send = notifyByFirebase($title, $body, $tokens, $data);
            }
        }

        return ResponseJson('200', 'تم الانتهاء من هذا الطلب', null);
    }

//    public function updateStatusOrder(Request $request)
//    {
//
//        RequestLog::create(['content' => $request->all(), 'service' => 'update Status Order']);
//
//        $validator = validator()->make($request->all(), [
//            'status' => 'required|in:cancelled,accept,complete',
//        ]);
//
//        if ($validator->fails()) {
//            return ResponseJson('0', $validator->errors()->first(), null);
//        }
//        $item = OrderItem::with('order')->where('id', $request->id)->first();
//        $item->status = $request->status;
//        $item->save();
//
//        $store = Store::where('id', $item->store_id)->first();
//        $car = Car::where('id', $item->order->car_id)->first();
//        $driver = Client::where('id', $car->client_id)->first();
//        $client = Client::where('id', $item->order->client_id)->first();
//        $product = Product::where('id', $item->product_id)->first();
//
//        if ($request->status == "cancelled") {
//
//            $clientMoney = $item->price;
//
//            $moneyAccount = new MoneyAccount();
//            $moneyAccount->order_id = $item->order->id;
//            $moneyAccount->client_id = $item->order->client_id;
//            $moneyAccount->total_money = $item->price;
//            $moneyAccount->client_money = $clientMoney;
//            $moneyAccount->status = 'bounced_back';
//            $moneyAccount->note = 'مرتجع الى المحفظة';
//            $moneyAccount->save();
//
//            if ($driver) {
//                //send notification to driver
//                $notification = $driver->notifications()->create([
//                    'id' => Uuid::uuid4(),
//                    'order_id' => $item->order->id,
//                    'type' => 'driver',
//                    'title' => 'تم الغاء هذا المنتج',
//                    'body' => $product->name . ' ' . 'بالغاء منتج ' . ' ' . $store->name . ' ' . 'قامت مؤسسة',
//                ]);
//
//                $tokens = $driver->tokens()->where('token', '!=', '')->pluck('token')->toArray();
//                if (count($tokens)) {
//                    $title = $notification->title;
//                    $body = $notification->body;
//                    $data = [
//                        'order_id' => $item->order->id
//                    ];
//                    $send = notifyByFirebase($title, $body, $tokens, $data);
//                }
//            }
//
//
//            if ($client) {
//                //send notification to client
//                $notification = $client->notifications()->create([
//                    'id' => Uuid::uuid4(),
//                    'order_id' => $item->order->id,
//                    'type' => 'driver',
//                    'title' => 'تم الغاء هذا المنتج',
//                    'body' => ' وسيتم اعادة المبلغ الى محفظتك ' . $product->name . ' ' . 'بالغاء منتج ' . ' ' . $store->name . ' ' . 'قامت مؤسسة',
//                ]);
//
//                $tokens = $client->tokens()->where('token', '!=', '')->pluck('token')->toArray();
//                if (count($tokens)) {
//                    $title = $notification->title;
//                    $body = $notification->body;
//                    $data = [
//                        'order_id' => $item->order->id
//                    ];
//                    $send = notifyByFirebase($title, $body, $tokens, $data);
//                }
//            }
//
//            return ResponseJson('200', 'تم رفض هذا الطلب', $item);
//        } elseif ($request->status == "accept") {
//
//            if ($driver) {
//                //send notification to driver
//                $notification = $driver->notifications()->create([
//                    'id' => Uuid::uuid4(),
//                    'order_id' => $item->order->id,
//                    'type' => 'driver',
//                    'title' => 'تم الموافقة هذا المنتج',
//                    'body' => $product->name . ' ' . 'بالموافقة على المنتج ' . ' ' . $store->name . ' ' . 'قامت مؤسسة',
//                ]);
//
//                $tokens = $driver->tokens()->where('token', '!=', '')->pluck('token')->toArray();
//                if (count($tokens)) {
//                    $title = $notification->title;
//                    $body = $notification->body;
//                    $data = [
//                        'order_id' => $item->order->id
//                    ];
//                    $send = notifyByFirebase($title, $body, $tokens, $data);
//                }
//            }
//
//            if ($client) {
//                //send notification to client
//                $notification = $client->notifications()->create([
//                    'id' => Uuid::uuid4(),
//                    'order_id' => $item->order->id,
//                    'type' => 'client',
//                    'title' => 'تم الموافقة على هذا المنتج',
//                    'body' => $product->name . ' ' . 'بالموافقة على منتج ' . ' ' . $store->name . ' ' . 'قامت مؤسسة',
//                ]);
//
//                $tokens = $client->tokens()->where('token', '!=', '')->pluck('token')->toArray();
//                if (count($tokens)) {
//                    $title = $notification->title;
//                    $body = $notification->body;
//                    $data = [
//                        'order_id' => $item->order->id
//                    ];
//                    $send = notifyByFirebase($title, $body, $tokens, $data);
//                }
//            }
//
//            $statusTrack = DB::table('track_order')->where('order_id', $item->order->id)->where('status', 'StoreDone')->first();
//
//            $track = [
//                'order_id' => $item->order->id,
//                'time' => Carbon::now()->format('H:i:s'),
//                'status' => 'StoreDone',
//                'statusName' => 'جارى تجهيز الطلب',
//            ];
//
//            if (!$statusTrack) {
//                DB::table('track_order')->insert($track);
//            }
//
//            return ResponseJson('200', 'تم الموافقه على هذا الطلب', $item);
//        } else {
//
//            if ($driver) {
//                $All_items_complete = OrderItem::where('order_id', $item->order->id)->where('store_id', $item->store_id)->where('status', 'complete')->get();
//                $All_items_cancelled = OrderItem::where('order_id', $item->order->id)->where('store_id', $item->store_id)->where('status', 'cancelled')->get();
//                $All_items = OrderItem::where('order_id', $item->order->id)->where('store_id', $item->store_id)->get();
//                $allMoneyOrder = $All_items_complete->Sum('price');
//
//                if (count($All_items_complete) + count($All_items_cancelled) == count($All_items)) {
//
//                    $siteMoney = settings()->commission * $allMoneyOrder / 100;
//
//                    $clientMoney = $allMoneyOrder - $siteMoney;
//
//                    $moneyAccount = new MoneyAccount();
//                    $moneyAccount->order_id = $item->order->id;
//                    $moneyAccount->store_id = $item->store_id;
//                    $moneyAccount->total_money = $allMoneyOrder;
//                    $moneyAccount->site_money = $siteMoney;
//                    $moneyAccount->client_money = $clientMoney;
//                    $moneyAccount->status = 'commission';
//                    $moneyAccount->note = 'نسبة المؤسسة';
//                    $moneyAccount->save();
//                }
//
//                //send notification to driver
//                $notification = $driver->notifications()->create([
//                    'id' => Uuid::uuid4(),
//                    'order_id' => $item->order->id,
//                    'type' => 'driver',
//                    'title' => 'تم الانتهاء هذا المنتج',
//                    'body' => $product->name . ' ' . 'بالانتهاء من هذا المنتج ' . ' ' . $store->name . ' ' . 'قامت مؤسسة',
//                ]);
//
//                $tokens = $driver->tokens()->where('token', '!=', '')->pluck('token')->toArray();
//                if (count($tokens)) {
//                    $title = $notification->title;
//                    $body = $notification->body;
//                    $data = [
//                        'order_id' => $item->order->id
//                    ];
//                    $send = notifyByFirebase($title, $body, $tokens, $data);
//                }
//            }
//
//            return ResponseJson('200', 'تم الانتهاء من هذا الطلب', null);
//        }
//    }

    public function filter(Request $request)
    {
        $store = Store::where('name', 'LIKE', '%' . $request->name . '%')->paginate();

        return ResponseJson('200', ' ناتج البحث عن ' . $request->name, $store);
    }

    public function commissions(Request $request)
    {

        $client = Auth::id();
        $store = Store::where('client_id', $client)->first();

        if (!$store) {
            return ResponseJson('0', 'لايوجد لك مؤسسة');
        }

        $money = MoneyAccount::where('store_id', $store->id);

//        if ($to && $from){$money->whereBetween('created_at', [$from, $to]);}

        $money = $money->get();

        if (count($money) == 0) {
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

        $items_complete = $OrderItem->where('status', 'complete')->get();

        $items_cancelled = $OrderItem->where('status', 'cancelled')->get();


        $data = [];
        $data['info'] = [
            'total' => number_format((float)$total, 2, '.', ''),
            'profit_site' => number_format((float)$profit_site, 2, '.', ''),
            'profit_store' => number_format((float)$profit_store, 2, '.', ''),
            'cash_withdrawal' => number_format((float)$cash_withdrawal, 2, '.', ''),
            'net_commissions' => number_format((float)$net_commissions, 2, '.', ''),
            'commission' => $commission
        ];


        foreach ($items_complete as $item) {
            $data['item_complete'][] = [
                'item_name' => $item->product->name,
                'quantity' => $item->where('product_id', $item->product->id)->where('order_id', $item->order_id)->sum('quantity'),
                'total_price' => $item->where('product_id', $item->product->id)->where('order_id', $item->order_id)->sum('price'),
            ];
        }

        foreach ($items_cancelled as $item) {
            $data['item_cancelled'][] = [
                'item_name' => $item->product->name,
                'quantity' => $item->where('product_id', $item->product->id)->where('order_id', $item->order_id)->sum('quantity'),
                'total_price' => $item->where('product_id', $item->product->id)->where('order_id', $item->order_id)->sum('price'),
            ];
        }

        return ResponseJson('200', 'تقارير المبيعات', $data);

    }

}

?>
