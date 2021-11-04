<?php

namespace App\Http\Controllers\Api\client;

use App\Car;
use App\Client;
use App\Events\NewNotification;
use App\Http\Controllers\Controller;
use App\MoneyAccount;
use App\Notifications\NewCarNotification;
use App\Order;
use App\RequestLog;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Resources\Car as CarResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Image;
use File;
use Ramsey\Uuid\Uuid;


class CarsController extends Controller
{

    public function index()
    {
        $car = CarResource::collection(Car::paginate(15));
        $count = count(Car::all());
        if ($count <= 0) {
            return ResponseJson('0', 'لا يوجد اى سيارات ');
        } else {
            return ResponseJson('200', 'كل السيارات', $car, $count);
        }
    }

    public function store(Request $request)
    {
        RequestLog::create(['content' => $request->except('_token'), 'service' => 'store_car']);

        $client = Auth::id();
        $car = Car::where('client_id', $client)->first();

//        if (!empty($car)){
//            return ResponseJson('0', 'لديك سياره بالفعل', null);
//        }

        $validator = validator()->make($request->all(), [
            'driver_license' => 'required|mimes:jpeg,jpg,png',
            'car_license' => 'required|mimes:jpeg,jpg,png',
            'personal_id' => 'required|mimes:jpeg,jpg,png',
            'image_car_front' => 'required|mimes:jpeg,jpg,png',
            'image_car_back' => 'required|mimes:jpeg,jpg,png',
            'Type_car' => 'required|in:1, 2, 3, 4, 5, 6, 7', // صغيره سيدان -- بكب صغيره -- بكب كبيره -- دينا -- سطحه -- شاحنة -- قلاب
            'number' => 'required',
            'car_model' => 'required',
            'brand_id' => 'required',
            'stc_pay' => 'required',
            'char_car' => 'required',
            'transfer_method' => 'required',
            'gender' => 'required',
            'nationality' => 'required',
//            'date_of_birth' => 'required'
        ]);

        if ($validator->fails()) {
            return ResponseJson('0', $validator->errors()->first(), null);
        }

        $car = new Car();
        $car->client_id = $request->user()->id;
        $car->Type_car = $request->Type_car;
        $car->number = $request->number;
        $car->car_model = $request->car_model;
        $car->brand_id = $request->brand_id;
        $car->stc_pay = $request->stc_pay;
        $car->bank_name = $request->bank_name;
        $car->name_card = $request->name_card;
        $car->ipan = $request->ipan;
        $car->char_car = $request->char_car;
        $car->transfer_method = $request->transfer_method;
        $car->gender = $request->gender;
        $car->nationality_id = $request->nationality;
        $car->date_of_birth = $request->date_of_birth;
        $car->activated = '0';
        $car->status = '0';


        if ($file = $request->file('personal_id')) {
            $car->personal_id = uploadImage($file, 'car');
        }

        if ($file = $request->file('driver_license')) {
            $car->driver_license = uploadImage($file, 'car');
        }

        if ($file = $request->file('car_license')) {
            $car->car_license = uploadImage($file, 'car');
        }

        if ($file = $request->file('image_car_front')) {
            $car->image_car_front = uploadImage($file, 'car');
        }

        if ($file = $request->file('image_car_back')) {
            $car->image_car_back = uploadImage($file, 'car');
        }

        $car->save();

        $admin = User::all();
        \Illuminate\Support\Facades\Notification::send($admin, new NewCarNotification($car));
        $NewCar = new CarResource(Car::find($car->id));

        $data = [
            'info' => $NewCar,
            'type' => 'newCar'
        ];
        event(new NewNotification($data));

        return ResponseJson('200', 'طلبك قيد الإنتظار سوف يتم الموافقة عليه فى أسرع وقت  :)', $NewCar);
    }

    public function show($id)
    {
        $car = new CarResource(Car::findOrFail($id));
        if ($car) {
            return ResponseJson('200', 'كل السيارات', $car);
        } else {
            return ResponseJson('0', 'لا يوجد اى  سيارة ');
        }
    }

    public function update(Request $request, $id)
    {
        RequestLog::create(['content' => $request->except('_token'), 'service' => 'update_car']);

        $validator = validator()->make($request->all(), [
            'driver_license' => 'mimes:jpeg,jpg,png',
            'car_license' => 'mimes:jpeg,jpg,png',
            'personal_id' => 'mimes:jpeg,jpg,png',
            'image_car_front' => 'mimes:jpeg,jpg,png',
            'image_car_back' => 'mimes:jpeg,jpg,png',
            'Type_car' => 'required|in:1, 2, 3, 4, 5, 6, 7', // صغيره سيدان -- بكب صغيره -- بكب كبيره -- دينا -- سطحه -- شاحنة -- قلاب
            'number' => 'required',
            'car_model' => 'required',
            'brand_id' => 'required',
            'stc_pay' => 'required',
            'char_car' => 'required'
        ]);

        if ($validator->fails()) {
            return ResponseJson('0', $validator->errors()->first(), null);
        }

        $car = Car::where('id', $id)->first();
        $client_id = $request->user()->id;
        if ($client_id == $car->client_id) {

            $car->update($request->all());

            if ($file = $request->file('driver_license')) {
                File::delete('storage/images/car/' . $car->driver_license);
                $car->driver_license = uploadImage($file, 'car');
            }

            if ($file = $request->file('car_license')) {
                File::delete('storage/images/car/' . $car->car_license);
                $car->car_license = uploadImage($file, 'car');
            }

            if ($file = $request->file('image_car_front')) {
                File::delete('storage/images/car/' . $car->image_car_front);
                $car->image_car_front = uploadImage($file, 'car');
            }

            if ($file = $request->file('image_car_back')) {
                File::delete('storage/images/car/' . $car->image_car_back);
                $car->image_car_back = uploadImage($file, 'car');
            }

            $car->save();
            $data = new CarResource(Car::find($car->id));
            return ResponseJson('200', 'تم تعديل البيانات ', $data);
        }

        return ResponseJson('404', 'ليس ملك لك ');
    }

    public function destroy(Request $request, $id)
    {
        RequestLog::create(['content' => $request->except('_token'), 'service' => 'delete_car']);

        $car = Car::where('id', $id)->first();
        $client_id = Auth::id();
        if ($client_id == $car->client_id) {
            $car->delete();
            return ResponseJson('1', 'تم حذف السيارة ');
        }
        return ResponseJson('404', 'ليس ملك لك ');
    }

    public function updateLocation(Request $request, $id)
    {
        $car = Car::where('id', $id)->first();
        $car->update($request->all());
    }

    public function SendCodeDelivered(Request $request)
    {
        RequestLog::create(['content' => $request->all(), 'service' => 'SendCodeDelivered']);

        $order = Order::where('id', $request->id)->firstOrFail();
        $client = Client::where('id', $order->client_id)->first();

        $code = rand(1111, 9999);


//        -----------------------------------------------------------------------

        //send notification

        $notification = $client->notifications()->create([
            'id' => Uuid::uuid4(),
            'order_id' => $order->id,
            'type' => 'client',
            'title' => 'كود تأكيد طلبك',
            'body' => 'كود تأكيد استلام طلبك يرجى اعطاءه لمندوبنا' . $code,
        ]);


        $tokens = $client->tokens()->where('token', '!=', '')->pluck('token')->toArray();

        if (count($tokens)) {
            $title = $notification->title;
            $body = $notification->body;
            $data = [
                'order_id' => $order->id
            ];
            $send = notifyByFirebase($title, $body, $tokens, $data);
        };

//        --------------------------------------------------------------------------------

        $update = $order->update(['code_delivered' => $code]);

        if ($update) {
            $username = settings()->sms_USERNAME;
            $password = settings()->sms_PASSWORD;
            $sender = settings()->sms_SENDER;
            $url = settings()->sms_URL;

            $msg = 'مرحبا' . ' ' . $order->name_buyer . ' ' . 'كود تأكيد استلام الطلب' . ' ' . $code;
            $url = $url;

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,
                "username=" . $username . "&password=" . $password . "&message=" . $msg . "&numbers=" . $order->billing_phone . "&sender=" . $sender . "&unicode=E&return=full");


            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $server_output = curl_exec($ch);

            curl_close($ch);


            return ResponseJson('200', 'تم ارسال كود تأكيد التسليم الى العميل يرجى كتابته لتاكيد التسليم', null);
        }
    }

    public function ChangeStatusDeliveryOrder(Request $request)
    {
        $order = Order::where('id', $request->order_id)->first();

        if (empty($order)) {
            return ResponseJson('0', 'لا يوجد هذا الطلب');
        }

        $car = Car::where('id', $order->car_id)->first();

        if (empty($car)) {
            return ResponseJson('0', 'لا يوجد هذا سياره');
        }

        $driver = Client::where('id', $car->client_id)->first();

        if ($request->status == 'GoStore') {
            $track = [
                'order_id' => $request->order_id,
                'time' => Carbon::now()->format('H:i:s'),
                'status' => 'GoStore',
                'statusName' => 'جارى التوجهه لمكان الاستلام',
            ];
            DB::table('track_order')->insert($track);

        } elseif ($request->status == 'InStore') {
            $track = [
                'order_id' => $request->order_id,
                'time' => Carbon::now()->format('H:i:s'),
                'status' => 'InStore',
                'statusName' => 'لقد وصلت مكان الاستلام',
            ];
            DB::table('track_order')->insert($track);

            $notification = $driver->notifications()->create([
                'id' => Uuid::uuid4(),
                'order_id' => $request->order_id,
                'type' => 'driver',
                'title' => 'اشعار وصول سائق',
                'body' => 'وصل الكابتن المسؤل عن الطلب رقم' . $request->order_id,
            ]);

            $tokens = $driver->tokens()->where('token', '!=', '')->pluck('token')->toArray();
            if (count($tokens)) {
                $title = $notification->title;
                $body = $notification->body;
                $data = [
                    'order_id' => $request->order_id,
                     'typeScreen' => 3 ,/// car 1 -- store 2 --- client 3

                ];
                $send = notifyByFirebase($title, $body, $tokens, $data);
            }

        } elseif ($request->status == 'ReceivedStore') {
            $track = [
                'order_id' => $request->order_id,
                'time' => Carbon::now()->format('H:i:s'),
                'status' => 'ReceivedStore',
                'statusName' => 'تم الإستلام من المتجر',
            ];

            $save = DB::table('track_order')->insert($track);

            if ($save) {
                $track = [
                    'order_id' => $request->order_id,
                    'time' => Carbon::now()->format('H:i:s'),
                    'status' => 'GoDelivery',
                    'statusName' => 'فى الطريق الى مكان التسليم',
                ];
                DB::table('track_order')->insert($track);
            }
        } elseif ($request->status == 'DeliveryArrived') {
            $track = [
                'order_id' => $request->order_id,
                'time' => Carbon::now()->format('H:i:s'),
                'status' => 'DeliveryArrived',
                'statusName' => 'لقد وصلت مكان التسليم',
            ];
            DB::table('track_order')->insert($track);

            $notification = $driver->notifications()->create([
                'id' => Uuid::uuid4(),
                'order_id' => $request->order_id,
                'type' => 'driver',
                'title' => 'اشعار وصول الطلب',
                'body' => 'لقد وصلت' . $driver->full_name,
            ]);

            $tokens = $driver->tokens()->where('token', '!=', '')->pluck('token')->toArray();
            if (count($tokens)) {
                $title = $notification->title;
                $body = $notification->body;
                $data = [
                    'order_id' => $request->order_id,
                 'typeScreen' => 3 ,/// car 1 -- store 2 --- client 3

                ];
                $send = notifyByFirebase($title, $body, $tokens, $data);
            }
        } else {
            echo 'done';
        }
    }

    public function StatusOrderDelivery(Request $request)
    {

        $order = Order::where('id', $request->id)->firstOrFail();

        if ($order->code_delivered == $request->code) {
            $order->status = 'Delivered';
            $order->code_delivered = null;
            $order->save();

            $track = [
                'order_id' => $order->id,
                'time' => Carbon::now()->format('H:i:s'),
                'status' => 'Delivered',
                'statusName' => 'تم تنفيذ الطلب بنجاح',
            ];
            DB::table('track_order')->insert($track);

            $siteMoney = settings()->commission * $order->shipped / 100;

            $clientMoney = $order->shipped - $siteMoney;

            $moneyAccount = new MoneyAccount();
            $moneyAccount->order_id = $order->id;
            $moneyAccount->car_id = $order->car_id;
            $moneyAccount->total_money = $order->shipped;
            $moneyAccount->site_money = $siteMoney;
            $moneyAccount->client_money = $clientMoney;
            $moneyAccount->status = 'commission';
            $moneyAccount->note = 'نسبة المندوب فى شحن الطلب';
            $moneyAccount->save();

            return ResponseJson('200', 'تم تسليم الطلب الى العميل', null);
        } else {

            return ResponseJson('0', 'تأكد من كود التسليم', null);
        }


    }

    public function MoneyCar()
    {
        $user = Auth::id();
        $car = Car::where('client_id', $user)->pluck('id')->first();
        if (empty($car)) {
            return ResponseJson('0', 'لا يوجد لك سياره', null);
        }

        $moneyCar = MoneyAccount::where('car_id', $car)->get();
        if (count($moneyCar) == 0) {
            return ResponseJson('0', 'لا يوجد لك اى تعاملات مالية :( ', null);
        } else {
            $car_money = $moneyCar->sum('client_money');
            $site_money = $moneyCar->sum('site_money');
            $total_money = $moneyCar->sum('total_money');

            $money = [
                'car_money' => $car_money,
                'site_money' => $site_money,
                'total_money' => $total_money,
            ];

            return ResponseJson('200', 'محفظتك', $money);

        }

    }

    public function commissions(Request $request)
    {
//        $to = $request->to;
//        $from = $request->from;
        $client = Auth::id();
        $car = Car::where('client_id', $client)->first();

        if (!$car) {
            return ResponseJson('0', 'لايوجد لك سياره');
        }

        $money = MoneyAccount::where('car_id', $car->id)->get();

        if (count($money) == 0) {
            return ResponseJson('200', 'لا يوجد لك اى تعاملات مالية :( ', null);
        }

        $cash_withdrawal = $money->where('status', 'remittance')->sum('client_money');

        $total = $money->where('status', 'commission')->sum('total_money');  //كل المبيعات

        $profit_site = $money->where('status', 'commission')->sum('site_money'); //ارباح الموقع

        $profit_store = $money->where('status', 'commission')->sum('client_money'); //ارباح المندوب

        $cash_withdrawal = $cash_withdrawal;  //التحويل النقدي المندوب

        $net_commissions = $total - $cash_withdrawal;  // المتبقى

        $commission = settings()->commission; //نسبة اللطبيق

        $orders_complete = Order::with('products')->where('car_id', $car->id)->where('status', 'Delivered')->get();


        $data = [];
        $data['info'] = [
            'total' => number_format((float)$total, 2, '.', ''),
            'profit_site' => number_format((float)$profit_site, 2, '.', ''),
            'profit_store' => number_format((float)$profit_store, 2, '.', ''),
            'cash_withdrawal' => number_format((float)$cash_withdrawal, 2, '.', ''),
            'net_commissions' => number_format((float)$net_commissions, 2, '.', ''),
            'commission' => $commission
        ];


        foreach ($orders_complete as $item) {
            $data['item_complete'][] = [
                'order_id' => $item->id,
                'location' => $item->billing_address,
                'total_price' => $item->where('id', $item->id)->sum('shipped'),
            ];
        }
//        $data = array_values((array) $data);

        return ResponseJson('200', 'تقارير المناديب', $data);
    }

    public function updateStausCar(Request $request)
    {
        $client = Auth::id();
        $store = Car::where('client_id', $client)->first();

        if (!$store) {
            return ResponseJson('0', 'لا يوجد لك سيارة');
        } else {
            $store->status = $request->status;
            $store->save();
            return ResponseJson('200', 'تم تعديل الحالة بنجاح', null);

        }
    }

}

?>
