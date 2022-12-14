<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Category;
use App\District;
use App\ExtraProduct;
use App\Http\Resources\UnitColor;
use App\MoneyAccount;
use App\Notification;
use App\Notifications\NewStoreNotification;
use App\OrderItem;
use App\RequestLog;
use App\SpacialCategory;
use App\Store;
use App\Product;
use App\User;
use http\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Image;
use File;
use Ramsey\Uuid\Uuid;

class StoreController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $records = Store::where(['active' => 1])->orwhere('active', 2)->get();
        return view('admin.store.index')->with(compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $district = District::all()->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE)->pluck('name', 'id');
        return view('admin.store.create')->with(compact($district));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        RequestLog::create(['content' => $request->except('_token'), 'service' => 'create Store']);

        $rules = [
            'name' => 'required|string|min:5',
            'client_id' => 'required|int|exists:clients,id',
            'category_id' => 'required|int|exists:categories,id',
            'phone1' => 'required',
            'phone2' => 'required',
            'site' => 'required|regex:/^./i',
            'facebook' => 'regex:/^./i',
            'whatsapp' => 'numeric',
            'district_id' => 'required|int|exists:cities,id',
            'minimum_order' => 'required|numeric',
            'company_register' => 'required|numeric',
            'num_tax' => 'required|numeric',
            'delivery_price' => 'required|numeric',
            'about' => 'required',
            'address' => 'required',
            'late' => 'required',
            'lang' => 'required',
            'email' => 'required|email',
            'logo' => 'required|mimes:jpeg,jpg,png',
            'cover' => 'required|mimes:jpeg,jpg,png',
            'name_responsible' => 'required|string|min:5',
        ];

        $this->validate($request, $rules);

        $records = new Store();
        $records->name = $request->input('name');
        $records->client_id = $request->input('client_id');
        $records->category_id = $request->input('category_id');
        $records->phone1 = $request->input('phone1');
        $records->phone2 = $request->input('phone2');
        $records->site = $request->input('site');
        $records->facebook = $request->input('facebook');
        $records->whatsapp = $request->input('whatsapp');
        $records->city_id = $request->input('district_id');
        $records->minimum_order = $request->input('minimum_order');
        $records->company_register = $request->input('company_register');
        $records->num_tax = $request->input('num_tax');
        $records->delivery_price = $request->input('delivery_price');
        $records->about = $request->input('about');
        $records->address = $request->input('address');
        $records->name_responsible = $request->input('name_responsible');
        $records->responsible_position = $request->input('responsible_position');
        $records->responsible_mobile = $request->input('responsible_mobile');
        $records->name_authorized = $request->input('name_authorized');
        $records->authorized_mobile = $request->input('authorized_mobile');
        $records->legal_name = $request->input('legal_name');
        $records->email = $request->input('email');
        $records->late = $request->input('late');
        $records->lang = $request->input('lang');
        $records->start_time = $request->start_time;
        $records->end_time = $request->end_time;
        $records->day_work = json_encode($request->day);
        $records->active = 1;
        $records->ratio = $request->ratio;

        if($file = $request->file('picture_contract')){
            $fileName = time().$file->getClientOriginalName();
            if($file->move('img/store/',$fileName)){
                // $photo   = Photo::create(['image' => $fileName]);
                $records['picture_contract'] = 'img/store/'. $fileName;
            }
        }

        if($file = $request->file('logo')){
            $fileName = time().$file->getClientOriginalName();
            if($file->move('img/store/',$fileName)){
                // $photo   = Photo::create(['image' => $fileName]);
                $records['logo'] = 'img/store/'. $fileName;
            }
        }

        if($file = $request->file('cover')){
            $fileName = time().$file->getClientOriginalName();
            if($file->move('img/store/',$fileName)){
                // $photo   = Photo::create(['image' => $fileName]);
                $records['cover'] = 'img/store/'. $fileName;
            }
        }

        $records->save();

        $records->categories()->attach($request->input('childCategory'));


        $username = settings()->sms_USERNAME;
        $password = settings()->sms_PASSWORD;
        $sender = settings()->sms_SENDER;
        $url = settings()->sms_URL;

        $msg = '???? ?????????? ?????????? ?????????? ???? ?????? ??????????????';

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
            "username=" . $username . "&password=" . $password . "&message=" . $msg . "&numbers=+966" . $request->phone1 . "&sender=" . $sender . "&unicode=E&return=full");


        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);

        curl_close($ch);

        flash()->success(__('lang.doneSave'));
        return redirect('/store');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $store = Store::findOrFail($id);
        $products = Product::where('store_id', $store->id)->paginate(16);
        $orders = OrderItem::with('order', 'product')->where('store_id', $store->id)->get();
        $money = MoneyAccount::where('store_id', $store->id)->get();
        $cash_withdrawal = $money->where('status', 'remittance')->sum('client_money');

        $total = $money->where('status', 'commission')->sum('total_money');  //???? ????????????????
        $profit_site = $money->where('status', 'commission')->sum('site_money'); //?????????? ????????????
        $profit_store = $money->where('status', 'commission')->sum('client_money'); //?????????? ??????????????
        $cash_withdrawal = $cash_withdrawal;  //?????????????? ???????????? ??????????????
        $net_commissions = $money->sum('client_money') - $cash_withdrawal;  // ??????????????

        return view('admin.store.show', compact('store', 'products', 'money', 'orders', 'total', 'profit_site', 'profit_store', 'cash_withdrawal', 'net_commissions'));
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
        $store = Store::first();
        $records = Store::findOrFail($id);
        return view('admin.store.edit')->with(compact('records', 'store', 'district'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        RequestLog::create(['content' => $request->except('_token'), 'service' => 'Update Store']);

        $rules = [
//          'name'=> 'required|string|min:5' ,
//          'client_id' => 'required|int|exists:clients,id',
//          'category_id' => 'required|int|exists:categories,id',
//          'phone1'=> 'required' ,
//          'phone2'=> 'required' ,
//          'site'=> 'required' ,
//          'facebook'=> 'required' ,
//          'whatsapp'=> 'required' ,
//          'minimum_order'=> 'required' ,
//          'company_register'=> 'required' ,
//          'num_tax'=> 'required' ,
//          'delivery_price'=> 'required' ,
//          'about'=> 'required' ,
//          'address'=> 'required' ,
        ];

        $this->validate($request, $rules);
        $records = Store::findOrFail($id);
        if ($request->lang === null && $request->late === null) {
            $lang = $records->lang;
            $late = $records->late;
        } else {
            $lang = $request->lang;
            $late = $request->late;
        }

        if ($request->district_id == null) {
            $district = $records->district_id;
        } else {
            $district = $request->district_id;
        }

        $records->name = $request->input('name');
        $records->client_id = $request->input('client_id');
        $records->category_id = $request->input('category_id');
        $records->phone1 = $request->input('phone1');
        $records->phone2 = $request->input('phone2');
        $records->site = $request->input('site');
        $records->facebook = $request->input('facebook');
        $records->whatsapp = $request->input('whatsapp');
        $records->city_id = $district;
        $records->minimum_order = $request->input('minimum_order');
        $records->company_register = $request->input('company_register');
        $records->num_tax = $request->input('num_tax');
        $records->delivery_price = $request->input('delivery_price');
        $records->about = $request->input('about');
        $records->address = $request->input('address');
        $records->name_responsible = $request->input('name_responsible');
        $records->responsible_position = $request->input('responsible_position');
        $records->responsible_mobile = $request->input('responsible_mobile');
        $records->name_authorized = $request->input('name_authorized');
        $records->authorized_mobile = $request->input('authorized_mobile');
        $records->legal_name = $request->input('legal_name');
        $records->email = $request->input('email');
        $records->lang = $lang;
        $records->late = $late;
        $records->start_time = $request->start_time;
        $records->end_time = $request->end_time;
        $records->ratio = $request->ratio;

        if ($request->day){
          $records->day_work = json_encode($request->day);
        }

        //Upload Image
        if ($request->hasFile('logo')) {
            File::delete('storage/images/store/' . $records->image);
            $image_tmp = Input::file('logo');
            if ($image_tmp->isValid()) {
                $filename = time() . '.' . $image_tmp->getClientOriginalExtension();
                $path = public_path('storage/images/store/' . $filename);
                $global = config('constants.image_Url');
                $url = $global . 'store/' . $filename;
                Image::make($image_tmp->getRealPath())->resize(468, 249)->save($path);
                $records->logo = $url;
            }
        }

        if ($file = $request->file('picture_contract')) {
            $records->picture_contract = uploadImage($file, 'store');
        }

        if ($file = $request->file('cover')) {
            $records->cover = uploadImage($file, 'store');
        }


        $records->save();
        flash()->success(__('lang.doneSave'));
        return redirect('/store');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        RequestLog::create(['content' => $id, 'service' => 'delete Store']);

        $records = Store::findOrFail($id);
        $records->delete();
        flash()->success(__('lang.doneDelete'));
        return redirect('/store');
    }


    public function pend()
    {
        $records = Store::where(['active' => 0])->paginate(20);
        return view('admin.store.pending')->with(compact('records'));
    }

    public function rejected()
    {
        $records = Store::where(['active' => 2])->paginate(20);
        return view('admin.store.rejected')->with(compact('records'));
    }


    public function active(Request $request, $id)
    {
        RequestLog::create(['content' => $id, 'service' => 'active Store']);

        $store = Store::findOrFail($id);
        if ($store->active == 1) {
            $store->active = 0;
        } else {
            $store->active = 1;
        }
        $store->save();
        flash()->success(__('lang.doneActive'));
        return back();
    }

    public function cancel(Request $request)
    {
        RequestLog::create(['content' => $request->store_id, 'service' => 'cancel Store']);

        $store = Store::findOrFail($request->store_id);
        $store->active = 2;
        $store->save();

        $client = \App\Client::where('id', $store->client_id)->first();
        $notification =  $client->notifications()->create([
            'id'       => Uuid::uuid4(),
            'title'    => '?????????? ?????? ??????????????',
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

    public function ProductShow($id)
    {
        $product = Product::with('colors', 'sizes', 'store')->where('id', $id)->first();
        return view('admin.store.productShow', compact('product'));
    }

    public function ProductCreate($id)
    {
        return view('admin.store.productCreate', compact('id'));
    }

    public function StoreProducts(Request $request)
    {

        RequestLog::create(['content' => $request->except('_token'), 'service' => 'create Product']);

        $rules = [
            'name' => 'required|string|min:5',
            'spacialCategory_id' => 'required|int|exists:spacial_categories,id',
            'brand_id' => 'required|int|exists:brands,id',
            'price' => 'required',
            'quantity' => 'required',
            'image1' => 'required|mimes:jpeg,jpg,png',
            'image2' => 'required|mimes:jpeg,jpg,png',
            'image3' => 'required|mimes:jpeg,jpg,png',
            'image4' => 'required|mimes:jpeg,jpg,png',
        ];

        $this->validate($request, $rules);

        $records = new Product();
        $records->name = $request->input('name');
        $records->type = $request->input('type');
        $records->store_id = $request->input('store_id');
        $records->spacialCategory_id = $request->input('spacialCategory_id');
        $records->brands_id = $request->input('brand_id');
        $records->price = $request->input('price');
        $records->quantity = $request->input('quantity');
        $records->code = $request->input('code');
        $records->notes = $request->input('notes');


        //Upload Image

        if ($file = $request->file('image1')) {
            $records->image1 = uploadImage($file, 'product');
        }

        if ($file = $request->file('image2')) {
            $records->image2 = uploadImage($file, 'product');
        }

        if ($file = $request->file('image3')) {
            $records->image3 = uploadImage($file, 'product');
        }

        if ($file = $request->file('image4')) {
            $records->image4 = uploadImage($file, 'product');
        }

        $records->save();


        if ($request->color_id){
            $sync_color_data = [];
            for ($c = 0, $cMax = count($request->color_id); $c < $cMax; $c++) {

                if ($request->color_price){
                    $colorPrice = $request->color_price;
                }else{
                    $colorPrice = [$c => 0];
                }

                $sync_color_data[$request->color_id[$c]] = ['price' => $colorPrice[$c]];
                $records->colors()->sync($sync_color_data);
            }
        }


        if ($request->size_id){
            $sync_size_data = [];
            for ($c = 0, $cMax = count($request->size_id); $c < $cMax; $c++) {

                if ($request->size_price){
                    $sizePrice = $request->size_price;
                }else{
                    $sizePrice = [$c => 0];
                }

                $sync_size_data[$request->size_id[$c]] = ['price' => $sizePrice[$c]];
                $records->sizes()->sync($sync_size_data);
            }
        }


        $items = [];
        $itemRemove = [];

        if ($request->extra_productName) {
            foreach ($request->extra_productName as $key => $item) {
                $items[] = [
                    'product_id' => $records->id,
                    'name' => $request->extra_productName[$key],
                    'price' => $request->extra_productPrice[$key],
                    'type' => '1',
                ];
            }
            DB::table('extra_products')->insert($items);
        }


        ///////////////////////////////////////////////////////

        if ($request->remove_productName) {
            foreach ($request->remove_productName as $key => $item) {
                $itemRemove[] = [
                    'product_id' => $records->id,
                    'name' => $request->remove_productName[$key],
                    'price' => $request->remove_productPrice[$key],
                    'type' => '0',
                ];
            }
            DB::table('extra_products')->insert($itemRemove);
        }

        flash()->success(__('lang.doneSave'));
        return redirect()->back();
    }


    public function getBrand($id)
    {
        $spacialCategory = SpacialCategory::with('store')->where('id', $id)->first()->store->category_id;
        $brand = Brand::where('category_id', $spacialCategory)->get();
        $output = view('admin.store.brand', ['brand' => $brand])->render();
        return response()->json([
            'output' => $output
        ]);
    }

    public function getColor($id)
    {
        $spacialCategory = SpacialCategory::with('store')->where('id', $id)->first()->store->category_id;
        $color = \App\UnitColor::where('category_id', $spacialCategory)->where('type', 'color')->get();
        $output = view('admin.store.color', ['color' => $color])->render();
        return response()->json([
            'output' => $output
        ]);
    }

    public function getSize($id)
    {
        $spacialCategory = SpacialCategory::with('store')->where('id', $id)->first()->store->category_id;
        $unit = \App\UnitColor::where('category_id', $spacialCategory)->where('type', 'unit')->get();
        $output = view('admin.store.unit', ['unit' => $unit])->render();
        return response()->json([
            'output' => $output
        ]);
    }

    public function getSizeplus($id)
    {
        $spacialCategory = SpacialCategory::with('store')->where('id', $id)->first()->store->category_id;
        $unit = \App\UnitColor::where('category_id', $spacialCategory)->where('type', 'unit')->get();
        return json_encode($unit);
    }

    public function getColorplus($id)
    {
        $spacialCategory = SpacialCategory::with('store')->where('id', $id)->first()->store->category_id;
        $color = \App\UnitColor::where('category_id', $spacialCategory)->where('type', 'color')->get();
        return json_encode($color);
    }

    public function ProductEdit($id)
    {
        $records = Product::findOrFail($id);

        $extraProducts = ExtraProduct::where('product_id', $id)->where('type', 1)->get();
        $removeProducts = ExtraProduct::where('product_id', $id)->where('type', 0)->get();
        return view('admin.store.productEdit')->with(compact('records', 'extraProducts', 'removeProducts'));
    }

    public function ProductUpdate(Request $request, $id)
    {
        RequestLog::create(['content' => $request->except('_token'), 'service' => 'Update Product']);

        $rules = [
            'name' => 'required|string|min:5',
            'spacialCategory_id' => 'required|int|exists:spacial_categories,id',
            'brand_id' => 'required|int|exists:brands,id',
            'price' => 'required',
            'quantity' => 'required',
            'image1' => 'mimes:jpeg,jpg,png',
            'image2' => 'mimes:jpeg,jpg,png',
            'image3' => 'mimes:jpeg,jpg,png',
            'image4' => 'mimes:jpeg,jpg,png',
        ];


        $this->validate($request, $rules);
        $records = Product::findOrFail($id);
        $records->name = $request->input('name');
        $records->type = $request->input('type');
        $records->spacialCategory_id = $request->input('spacialCategory_id');
        $records->brands_id = $request->input('brand_id');
        $records->price = $request->input('price');
        $records->quantity = $request->input('quantity');
        $records->code = $request->input('code');
        $records->notes = $request->input('notes');

        //Upload Image

        if ($file = $request->file('image1')) {
            $records->image1 = uploadImage($file, 'product');
        }

        if ($file = $request->file('image2')) {
            $records->image2 = uploadImage($file, 'product');
        }

        if ($file = $request->file('image3')) {
            $records->image3 = uploadImage($file, 'product');
        }

        if ($file = $request->file('image4')) {
            $records->image4 = uploadImage($file, 'product');
        }

        $records->save();



        $extra_product_delete = ExtraProduct::where('product_id', $id)->delete();

        $items = [];
        $itemRemove = [];
        if ($request->extra_productName) {
            foreach ($request->extra_productName as $key => $item) {
                $items[] = [
                    'product_id' => $records->id,
                    'name' => $request->extra_productName[$key],
                    'price' => $request->extra_productPrice[$key],
                    'type' => '1',
                ];
            }
            DB::table('extra_products')->insert($items);
        }


        ///////////////////////////////////////////////////////

        if ($request->remove_productName) {
            foreach ($request->remove_productName as $key => $item) {
                $itemRemove[] = [
                    'product_id' => $records->id,
                    'name' => $request->remove_productName[$key],
                    'price' => $request->remove_productPrice[$key],
                    'type' => '0',
                ];
            }
            DB::table('extra_products')->insert($itemRemove);
        }

//        $records->colors()->delete();

        if ($request->color_id){
            $sync_color_data = [];
            for ($c = 0, $cMax = count($request->color_id); $c < $cMax; $c++) {

                if ($request->color_price){
                    $colorPrice = $request->color_price;
                }else{
                    $colorPrice = [$c => 0];
                }

                $sync_color_data[$request->color_id[$c]] = ['price' => $colorPrice[$c]];
                $records->colors()->sync($sync_color_data);
            }
        }


        if ($request->size_id){
            $sync_size_data = [];
            for ($c = 0, $cMax = count($request->size_id); $c < $cMax; $c++) {

                if ($request->size_price){
                    $sizePrice = $request->size_price;
                }else{
                    $sizePrice = [$c => 0];
                }

                $sync_size_data[$request->size_id[$c]] = ['price' => $sizePrice[$c]];
                $records->sizes()->sync($sync_size_data);
            }
        }

        flash()->success(__('lang.doneEdit'));
        return redirect()->back();

    }

    public function getcategory($id)
    {
        $records = Category::where('parent_id', $id)->get();
        $output = view('admin.store.category', ['records' => $records])->render();
        return response()->json([
            'output' => $output
        ]);
    }


}

?>
