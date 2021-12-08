<?php

namespace App\Http\Controllers\Dashboard;

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
// use File;
use Illuminate\Support\Facades\File;
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
        $records = Store::where('active', 1)->get();
        return view('dashboard.pages.store.index')->with(compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $district = District::all()->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE)->pluck('name', 'id');
        return view('dashboard.pages.store.create')->with(compact($district));
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
        $records->city_id = $request->input('city_id');
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
                $records['picture_contract'] = 'img/store/'. $fileName;
            }
        }

        if($file = $request->file('logo')){
            $fileName = time().$file->getClientOriginalName();
            if($file->move('img/store/',$fileName)){
                $records['logo'] = 'img/store/'. $fileName;
            }
        }

        if($file = $request->file('cover')){
            $fileName = time().$file->getClientOriginalName();
            if($file->move('img/store/',$fileName)){
                $records['cover'] = 'img/store/'. $fileName;
            }
        }

        $records->save();

        $records->categories()->attach($request->input('childCategory'));


        $username = settings()->sms_USERNAME;
        $password = settings()->sms_PASSWORD;
        $sender = settings()->sms_SENDER;
        $url = settings()->sms_URL;

        $msg = 'تم انشاء منشأه جديده لك على تطبيقنا';

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
            "username=" . $username . "&password=" . $password . "&message=" . $msg . "&numbers=+966" . $request->phone1 . "&sender=" . $sender . "&unicode=E&return=full");


        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);

        curl_close($ch);

        flash()->success(__('institution.savedSuccessfully'));
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

        $total = $money->where('status', 'commission')->sum('total_money');  //كل المبيعات
        $profit_site = $money->where('status', 'commission')->sum('site_money'); //ارباح الموقع
        $profit_store = $money->where('status', 'commission')->sum('client_money'); //ارباح المؤسسة
        $cash_withdrawal = $cash_withdrawal;  //التحويل النقدي للمؤسسة
        $net_commissions = $money->sum('client_money') - $cash_withdrawal;  // المتبقى

        // return $store->day_work;
        return view('dashboard.pages.store.show', compact('store', 'products', 'money', 'orders', 'total', 'profit_site', 'profit_store', 'cash_withdrawal', 'net_commissions'));
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
        return view('dashboard.pages.store.edit')->with(compact('records', 'store', 'district'));
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

        if ($request->city_id == null) {
            $city_id = $records->city_id;
        } else {
            $city_id = $request->city_id;
        }

        $records->name = $request->input('name');
        $records->client_id = $request->input('client_id');
        $records->category_id = $request->input('category_id');
        $records->phone1 = $request->input('phone1');
        $records->phone2 = $request->input('phone2');
        $records->site = $request->input('site');
        $records->facebook = $request->input('facebook');
        $records->whatsapp = $request->input('whatsapp');
        $records->city_id = $city_id;
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
        if($file = $request->file('logo')){
            if (File::exists($records->logo)){
                @unlink(public_path().'/'.$records->logo);
            }
            $fileName = time().'instilogo'.$file->getClientOriginalName();
            if($file->move('img/store/',$fileName)){
                $records['logo'] = 'img/store/'. $fileName;
            }
        }

        if($file = $request->file('cover')){
            if (File::exists($records->cover)){
                @unlink(public_path().'/'.$records->cover);
            }
            $fileName = time().'insticover'.$file->getClientOriginalName();
            if($file->move('img/store/',$fileName)){
                $records['cover'] = 'img/store/'. $fileName;
            }
        }

        if($file = $request->file('picture_contract')){
            if (File::exists($records->picture_contract)){
                @unlink(public_path().'/'.$records->picture_contract);
            }
            $fileName = time().'insticontract'.$file->getClientOriginalName();
            if($file->move('img/store/',$fileName)){
                $records['picture_contract'] = 'img/store/'. $fileName;
            }
        }

        $records->save();
        flash()->success(__('institution.editedSuccessfully'));
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

        if (File::exists($records->logo)){
            @unlink(public_path().'/'.$records->logo);
        }

        if (File::exists($records->cover)){
            @unlink(public_path().'/'.$records->cover);
        }

        if (File::exists($records->picture_contract)){
            @unlink(public_path().'/'.$records->picture_contract);
        }

        $records->delete();
        flash()->success(__('institution.deletedSuccessfully'));
        return redirect('/store');
    }


    public function pend()
    {
        $records = Store::where(['active' => 0])->paginate(20);
        return view('dashboard.pages.store.pending')->with(compact('records'));
    }

    public function rejected()
    {
        $records = Store::where(['active' => 2])->paginate(20);
        return view('dashboard.pages.store.rejected')->with(compact('records'));
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
        flash()->success($store->active == 1 ? __('institution.activatedSuccessfully') : __('category.blockedSuccessfully'));

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


        flash()->success(__('institution.canceledSuccessfully'));
        return back();
    }

    public function ProductShow($id)
    {
        $product = Product::with('colors', 'sizes', 'store')->where('id', $id)->first();
        return view('dashboard.pages.store.productShow', compact('product'));
    }

    public function ProductCreate($id)
    {
        return view('dashboard.pages.store.productCreate', compact('id'));
    }

    public function StoreProducts(Request $request)
    {
        // return $request->all();
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
            $fileName = time().'image1'.$file->getClientOriginalName();
            if($file->move('img/product/',$fileName)){
                $records->image1 = 'img/product/'. $fileName;
            }
        }

        if ($file = $request->file('image2')) {
            $fileName = time().'image2'.$file->getClientOriginalName();
            if($file->move('img/product/',$fileName)){
                $records->image2 = 'img/product/'. $fileName;
            }
        }

        if ($file = $request->file('image3')) {
            $fileName = time().'image3'.$file->getClientOriginalName();
            if($file->move('img/product/',$fileName)){
                $records->image3 = 'img/product/'. $fileName;
            }
        }
        
        if ($file = $request->file('image4')) {
            $fileName = time().'image4'.$file->getClientOriginalName();
            if($file->move('img/product/',$fileName)){
                $records->image4 = 'img/product/'. $fileName;
            }
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

        // if ($request->extra_productName) {
        //     foreach ($request->extra_productName as $key => $item) {
        //         $items[] = [
        //             'product_id' => $records->id,
        //             'name' => $request->extra_productName[$key],
        //             'price' => $request->extra_productPrice[$key],
        //             'type' => '1',
        //         ];
        //     }
        //     DB::table('extra_products')->insert($items);
        // }


        ///////////////////////////////////////////////////////

        // if ($request->remove_productName) {
        //     foreach ($request->remove_productName as $key => $item) {
        //         $itemRemove[] = [
        //             'product_id' => $records->id,
        //             'name' => $request->remove_productName[$key],
        //             'price' => $request->remove_productPrice[$key],
        //             'type' => '0',
        //         ];
        //     }
        //     DB::table('extra_products')->insert($itemRemove);
        // }

        flash()->success(__('institution.productSavedSuccessfully'));
        return redirect('store/'.$request->store_id);
    }


    public function getBrand($id)
    {
        $spacialCategory = SpacialCategory::with('store')->where('id', $id)->first()->store->category_id;
        $brand = Brand::where('category_id', $spacialCategory)->get();
        $output = view('dashboard.pages.store.brand', ['brand' => $brand])->render();
        return response()->json([
            'output' => $output
        ]);
    }

    public function getColor($id)
    {
        $spacialCategory = SpacialCategory::with('store')->where('id', $id)->first()->store->category_id;
        $color = \App\UnitColor::where('category_id', $spacialCategory)->where('type', 'color')->get();
        $output = view('dashboard.pages.store.color', ['color' => $color])->render();
        return response()->json([
            'output' => $output
        ]);
    }

    public function getSize($id)
    {
        $spacialCategory = SpacialCategory::with('store')->where('id', $id)->first()->store->category_id;
        $unit = \App\UnitColor::where('category_id', $spacialCategory)->where('type', 'unit')->get();
        $output = view('dashboard.pages.store.unit', ['unit' => $unit])->render();
        return response()->json([
            'output' => $output
        ]);
    }

    public function getSizeplus($id)
    {
        $spacialCategory = SpacialCategory::with('store')->where('id', $id)->first()->store->category_id;
        $unit = \App\UnitColor::where('category_id', $spacialCategory)->where('type', 'unit')->get();
        $unit = [];
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

        // $extraProducts = ExtraProduct::where('product_id', $id)->where('type', 1)->get();
        // $removeProducts = ExtraProduct::where('product_id', $id)->where('type', 0)->get();
        // return view('dashboard.pages.store.productEdit')->with(compact('records', 'extraProducts', 'removeProducts'));
        return view('dashboard.pages.store.productEdit')->with(compact('records'));
    }

    public function ProductUpdate(Request $request, $id)
    {
        return $request->all();
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
            if (File::exists($records->image1)){
                @unlink(public_path().'/'.$records->image1);
            }
            $fileName = time().'image1'.$file->getClientOriginalName();
            if($file->move('img/product/',$fileName)){
                $records->image1 = 'img/product/'. $fileName;
            }
        }

        if ($file = $request->file('image2')) {
            if (File::exists($records->image2)){
                @unlink(public_path().'/'.$records->image2);
            }
            $fileName = time().'image2'.$file->getClientOriginalName();
            if($file->move('img/product/',$fileName)){
                $records->image2 = 'img/product/'. $fileName;
            }
        }

        if ($file = $request->file('image3')) {
            if (File::exists($records->image3)){
                @unlink(public_path().'/'.$records->image3);
            }
            $fileName = time().'image3'.$file->getClientOriginalName();
            if($file->move('img/product/',$fileName)){
                $records->image3 = 'img/product/'. $fileName;
            }
        }
        
        if ($file = $request->file('image4')) {
            if (File::exists($records->image4)){
                @unlink(public_path().'/'.$records->image4);
            }
            $fileName = time().'image4'.$file->getClientOriginalName();
            if($file->move('img/product/',$fileName)){
                $records->image4 = 'img/product/'. $fileName;
            }
        }

        $records->save();

        // $extra_product_delete = ExtraProduct::where('product_id', $id)->delete();

        $items = [];
        $itemRemove = [];
        // if ($request->extra_productName) {
        //     foreach ($request->extra_productName as $key => $item) {
        //         $items[] = [
        //             'product_id' => $records->id,
        //             'name' => $request->extra_productName[$key],
        //             'price' => $request->extra_productPrice[$key],
        //             'type' => '1',
        //         ];
        //     }
        //     DB::table('extra_products')->insert($items);
        // }


        ///////////////////////////////////////////////////////

        // if ($request->remove_productName) {
        //     foreach ($request->remove_productName as $key => $item) {
        //         $itemRemove[] = [
        //             'product_id' => $records->id,
        //             'name' => $request->remove_productName[$key],
        //             'price' => $request->remove_productPrice[$key],
        //             'type' => '0',
        //         ];
        //     }
        //     DB::table('extra_products')->insert($itemRemove);
        // }

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

        flash()->success(__('institution.productEditedSuccessfully'));
        return redirect('store/'.$request->store_id);

    }

    public function getcategory($id)
    {
        $records = Category::where('parent_id', $id)->get();
        $output = view('dashboard.pages.store.category', ['records' => $records])->render();
        return response()->json([
            'output' => $output
        ]);
    }


}

?>
