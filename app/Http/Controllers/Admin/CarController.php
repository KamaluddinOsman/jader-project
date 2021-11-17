<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\District;
use App\MoneyAccount;
use App\Order;
use App\Product;
use App\Car;
use App\RequestLog;
use App\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Ramsey\Uuid\Uuid;

class CarController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $records = Car::where(['activated' => 1])->get();
        return view('admin.car.index')->with(compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.car.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        RequestLog::create(['content' => $request->except('_token'), 'service' => 'create car']);

        $rules = [
            'driver_license' => 'required|mimes:jpeg,jpg,png',
            'car_license' => 'required|mimes:jpeg,jpg,png',
            'personal_id' => 'required|mimes:jpeg,jpg,png',
            'image_car_front' => 'required|mimes:jpeg,jpg,png',
            'image_car_back' => 'required|mimes:jpeg,jpg,png',
            'Type_car' => 'required|in:1, 2, 3, 4, 5, 6, 7', // صغيره سيدان -- بكب صغيره -- بكب كبيره -- دينا -- سطحه -- شاحنة -- قلاب
            'number' => 'required',
            'car_model' => 'required',
            'personal_image' => 'required',
            'brand_id' => 'required',
            'char_car' => 'required',
            'stc_pay' => 'required',
        ];

        $this->validate($request, $rules);

        $car = new Car();
        $car->client_id = $request->client_id;
        $car->Type_car = $request->Type_car;
        $car->personal_id = $request->personal_id;
        $car->number = $request->number;
        $car->car_model = $request->car_model;
        $car->brand_id = $request->brand_id;
        $car->char_car = $request->char_car;
        $car->stc_pay = $request->stc_pay;
        $car->bank_name = $request->bank_name;
        $car->name_card = $request->name_card;
        $car->ipan = $request->ipan;
        $car->activated = '1';

        if ($file = $request->file('personal_image')) {
            $car->personal_image = uploadImage($file, 'car');
        }

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
        flash()->success(__('lang.doneSave'));
        return redirect('/car');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $car = Car::findOrFail($id);
        $orders = Order::where('car_id', $id)->get();
        $money = MoneyAccount::where('car_id', $id)->get();
        $cash_withdrawal = $money->where('status', 'remittance')->sum('client_money');

        $total = $money->where('status', 'commission')->sum('total_money');  //كل المبيعات

        $profit_site = $money->where('status', 'commission')->sum('site_money'); //ارباح الموقع

        $profit_store = $money->where('status', 'commission')->sum('client_money'); //ارباح المندوب

        $cash_withdrawal = $cash_withdrawal;  //التحويل النقدي للمؤسسة
        $net_commissions = $total - $cash_withdrawal;  // المتبقى
        return view('admin.car.show', compact('car', 'orders', 'money', 'total', 'profit_site', 'profit_store', 'cash_withdrawal', 'net_commissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $district = District::all()->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE)->pluck('name', 'id');
        $car = Car::first();
        $records = Car::findOrFail($id);
        return view('admin.car.edit')->with(compact('records', 'car', 'district'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        RequestLog::create(['content' => $request->except('_token'), 'service' => 'update car']);


        $rules = [
            'personal_image' => 'mimes:jpeg,jpg,png',
            'driver_license' => 'mimes:jpeg,jpg,png',
            'car_license' => 'mimes:jpeg,jpg,png',
            'personal_id' => 'mimes:jpeg,jpg,png',
            'image_car_front' => 'mimes:jpeg,jpg,png',
            'image_car_back' => 'mimes:jpeg,jpg,png',
            'Type_car' => 'required|in:1, 2, 3, 4, 5, 6, 7', // صغيره سيدان -- بكب صغيره -- بكب كبيره -- دينا -- سطحه -- شاحنة -- قلاب
            'number' => 'required',
            'car_model' => 'required',
            'brand_id' => 'required',
            'char_car' => 'required',
            'stc_pay'  => 'stc_pay',
        ];

        $this->validate($request, $rules);

        $car = Car::findOrFail($id);
        $car->client_id = $request->client_id;
        $car->Type_car = $request->Type_car;
        $car->number = $request->number;
        $car->car_model = $request->car_model;
        $car->brand_id = $request->brand_id;
        $car->char_car = $request->char_car;
        $car->stc_pay = $request->stc_pay;
        $car->bank_name = $request->bank_name;
        $car->name_card = $request->name_card;
        $car->ipan = $request->ipan;

        if ($file = $request->file('personal_id')) {
            $car->personal_id = uploadImage($file, 'car');
        }

        if ($file = $request->file('personal_image')) {
            $car->personal_image = uploadImage($file, 'car');
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
        flash()->success(__('lang.doneSave'));
        return redirect('/car');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        RequestLog::create(['content' => $id, 'service' => 'delete car']);

        $records = Car::findOrFail($id);
        $records->delete();
        flash()->success(__('lang.doneDelete'));
        return redirect('/car');
    }


    public function pend()
    {
        $records = Car::where(['activated' => 0])->paginate(20);
        return view('admin.car.pending')->with(compact('records'));
    }

    public function rejected()
    {
        $records = Car::where(['activated' => 2])->paginate(20);
        return view('admin.car.rejected')->with(compact('records'));
    }

    public function active($id)
    {
        RequestLog::create(['content' => $id, 'service' => 'active car']);

        $car = Car::findOrFail($id);
        if ($car->activated == 1) {
            $car->activated = 0;
        } else {
            $car->activated = 1;
        }
        $car->save();
        flash()->success(__('lang.doneActive'));
        return redirect()->back();
    }

    public function cancel(Request $request)
    {
        RequestLog::create(['content' => $request->car_id, 'service' => 'cancel Store']);

        $car = Car::findOrFail($request->car_id);
        $car->activated = 2;
        $car->save();

        $client = \App\Client::where('id', $car->client_id)->first();
        $notification =  $client->notifications()->create([
            'id'       => Uuid::uuid4(),
            'title'    => 'الغاء طلب انظمامك',
            'body'     => $request->body ,
        ]);


        $tokens = $client->tokens()->where('token','!=','')->pluck('token')->toArray();
        if (count($tokens)){
            $title = $notification->title;
            $body = $notification->body;
            $data = [
                'test' => '1'
            ];
            $send = notifyByFirebase($title,$body,$tokens, $data);
        };


        flash()->success(__('lang.doneCancel'));
        return back();
    }

}

?>
