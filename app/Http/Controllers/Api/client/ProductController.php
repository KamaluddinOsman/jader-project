<?php

namespace App\Http\Controllers\Api\client;

use App\Cart;
use App\Favorite;
use App\Product;
use App\ProductAttr;
use App\ProductAttrItem;
use App\ProductsQuestions;
use App\RequestLog;
use App\Store;
use Illuminate\Http\Request;
use App\Http\Resources\Product as PorductResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Image;
use File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return PorductResource
     */
    public function index(Request $request)
    {
        $validator = validator()->make($request->all(), [

        ]);

        if ($validator->fails()) {
            return ResponseJson('0', $validator->errors()->first(), null);
        }

        $product = [];

        $product = Product::with('offers', 'ProductAttr');

        if ($request->spacialCategory_id) {
            $product = $product->where('spacialCategory_id', $request->spacialCategory_id);
        }

        if ($request->store_id == null){
            $product = $product->where('status', '=', '1');
        }

        if ($request->store_id) {
            $product = $product->where('store_id', $request->store_id);
        }
        if ($request->type) {
            $product = $product->where('type', $request->type);
        }

        $product = $product->WhereHas('store', function ($query) {
            $query->where('active', '1');
        })->paginate();


        foreach ($product as $prod) {
            $cart = Cart::where('product_id', $prod->id)->where('client_id', $request->client_id)->groupBy('product_id')->count();
            if ($cart != 0) {
                $product[$prod->id - 1]['cart_count'] = $cart;
            }
        }


        if (count($product) > 0) {
            return ResponseJson('200', 'كل البيانات', $product);
        } else {
            return ResponseJson('0', 'لا يوجد اى  بيانات ', null);
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
        RequestLog::create(['content' => $request->all(), 'service' => 'add product']);

        // لو الحساب متوقف مينفع يعمل منتج
        $store = Store::where('id', $request->store_id)->pluck('active')->first();


        // if ($store == 0) {
        //     return ResponseJson('0', 'لم يتم الموافقه على المنشأه الخاصه بك يرجى التواصل مع الاداره شكرا لك', null);
        // }
        $validator = validator()->make($request->all(), [
            'store_id' => 'required|int|exists:stores,id',
            'spacialCategory_id' => 'required|int|exists:spacial_categories,id',
            'type' => 'required|in:0,1',
            'brands_id' => 'int|exists:brands,id',
            'name' => 'required',
            'quantity' => 'int',
            'price' => 'required',
            'code' => 'required',
            'image1' => 'required|mimes:jpeg,jpg,png',
            'image2' => 'mimes:jpeg,jpg,png',
            'image3' => 'mimes:jpeg,jpg,png',
            'image4' => 'mimes:jpeg,jpg,png',
        ]);

        $quantity = $request->quantity  ?? 1000000;
        if ($validator->fails()) {
            return ResponseJson('0', $validator->errors()->first(), null);
        }

        try {
            DB::beginTransaction();

            $product = new Product();
            $product->store_id = $request->store_id;
            $product->spacialCategory_id = $request->spacialCategory_id;
            $product->type = $request->type; //1 product or  0 service
            $product->brands_id = $request->brands_id;
            $product->name = $request->name;
            $product->quantity = $quantity;
            $product->rest_quantity = $quantity;
            $product->price = $request->price;
            $product->code = $request->code;
            $product->notes = $request->notes;
            $product->calories = $request->calories;
            $product->rate = 0;
            $product->status = 0;

            if ($file = $request->file('image1')) {
                $product->image1 = uploadImage($file, 'product');
            }

            if ($file = $request->file('image2')) {
                $product->image2 = uploadImage($file, 'product');
            }

            if ($file = $request->file('image3')) {
                $product->image3 = uploadImage($file, 'product');
            }

            if ($file = $request->file('image4')) {
                $product->image4 = uploadImage($file, 'product');
            }

            $product->save();

            $size_product  = json_decode($request->size_product);
            $color_product = json_decode($request->color_product);


            if ($color_product) {
                $sync_color_data = [];
                for ($c = 0; $c < count($color_product); $c++) {
                    if ($request->color_price) {
                        $colorPrice = json_decode($request->color_price);
                    } else {
                        $colorPrice = [$c => 0];
                    }
                    $sync_color_data[$color_product[$c]] = ['price' => $colorPrice[$c]];
                }
                $product->colors()->sync($sync_color_data);
            }

            if ($size_product) {
                $sync_size_data = [];
                for ($c = 0; $c < count($size_product); $c++) {
                    if ($request->size_price) {
                        $sizePrice = json_decode( $request->size_price);
                    } else {
                        $sizePrice = [$c => 0];
                    }

                    $sync_size_data[$size_product[$c]] = ['price' => $sizePrice[$c]];


                }
                $product->sizes()->sync($sync_size_data);
            }

            DB::commit();

        } catch (\Exception $ex) {

            return $ex;
            DB::rollback();
            return ResponseJson('500', 'نأسف لك حدث مشكلة حاول مره اخرى', null);
        }

        return ResponseJson('200', 'تم الحفظ بنجاح وفى انتظار القسم المختص', $product);

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show(Request $request, $id)
    {
        $user_id = Auth::user()->id;
        $product = product::with('store', 'offers', 'spacialCategory', 'brand', 'colors', 'sizes', 'reviews')->findOrFail($id);
        $carts = Cart::with('size')->where('product_id', $id)->where('client_id', $user_id)->get();


        $product = [
            'id' => $product->id,
            'store_id' => $product->store_id,
            'spacialCategory_id' => $product->spacialCategory_id,
            'brands_id' => $product->brands_id,
            'name' => $product->name,
            'type' => $product->type,
            'rate' => $product->rate,
            'price' => $product->price,
            'code' => $product->code,
            'quantity' => $product->quantity,
            'rest_quantity' => $product->rest_quantity,
            'notes' => $product->notes,
            'created_at' => $product->created_at,
            'updated_at' => $product->updated_at,
            'favourite' => $product->favourite,
            'offers' => $product->offers,
            'offer' => $product->offer,
            'reviews' => $product->reviews,
            'colors' => $product->colors,
            'sizes' => $product->sizes,
            'store' => $product->store,
            'brand' => $product->brand,
            'calories' => $product->calories,
            'spacialCategory' => $product->spacialCategory,
            'productAttr' =>  $request->typeScreen == 'client' ?  $product->ProductAttrActive : $product->ProductAttr,
            'image' => [
                $product->image1 = $product->image1,
                $product->image2 = $product->image2,
                $product->image3 = $product->image3,
                $product->image4 = $product->image4,
            ],
        ];

        $cart = [];
        $attr = [];

        foreach ($carts as $row) {

            if ($row->product_attr ) {
                
                if(is_array(json_decode(json_decode($row->product_attr)))){
                   
                     foreach (json_decode(json_decode($row->product_attr)) as $key => $AttrItem) {
                    

                    $productAttrItem[$key] = ProductAttrItem::where('id', $AttrItem)->with('ProductAttr')->first();
                    $attr[$key]= [
                        'title' => $productAttrItem[$key]->ProductAttr->title,
                        'description' => $productAttrItem[$key]->description,
                    ];             
                    } 
                }
                 
            } else {
                $attr = null;
//                $attr = implode(" , ",$productAttrItem);
            }




            $cart[$row->id]['cart_id'] = $row->id;
            $cart[$row->id]['name'] = $product['name'];
            $cart[$row->id]['quantity'] = $row->quantity;
            $cart[$row->id]['total_price'] = $row->total_price;
            $cart[$row->id]['size'] = $row->size->name ?? '';
            $cart[$row->id]['productAttr'] = $attr;

        }


        $data = [
            'cart' => array_values((array)$cart),
            'product' => $product,
        ];


        if ($product) {
            return ResponseJson('200', 'المنتج', $data);
        } else {
            return ResponseJson('0', 'لا يوجد هذا المنتج ');
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
    public function update(Request $request, $id)
    {
        RequestLog::create(['content' => $request->all(), 'service' => 'update product']);

        $validator = validator()->make($request->all(), [
            'store_id' => 'required|int|exists:stores,id',
            'spacialCategory_id' => 'required|int|exists:spacial_categories,id',
            'type' => 'required|in:0,1',
            'brands_id' => 'int|exists:brands,id',
            'name' => 'required',
            'quantity' => 'int',
            'price' => 'required',
            'code' => 'required',
        ]);

        if ($validator->fails()) {
            return ResponseJson('0', $validator->errors()->first(), null);
        }

        $product = Product::findOrFail($id);
        $product->update($request->all());

        $product->rest_quantity += $request->quantity;

        if ($file = $request->file('image1')) {
            File::delete('storage/images/product/' . $product->image1);
            $product->image1 = uploadImage($file, 'product');
        }

        if ($file = $request->file('image2')) {
            File::delete('storage/images/product/' . $product->image2);
            $product->image2 = uploadImage($file, 'product');
        }

        if ($file = $request->file('image3')) {
            File::delete('storage/images/product/' . $product->image3);
            $product->image3 = uploadImage($file, 'product');
        }

        if ($file = $request->file('image4')) {
            File::delete('storage/images/product/' . $product->image4);
            $product->image4 = uploadImage($file, 'product');
        }

        $product->save();

        $size_product  = json_decode($request->size_product);
        $color_product = json_decode($request->color_product);

        if ($color_product) {
            $sync_color_data = [];
            for ($c = 0; $c < count($color_product); $c++) {
                if ($request->color_price) {
                    $colorPrice = json_decode($request->color_price);
                } else {
                    $colorPrice = [$c => 0];
                }
                $sync_color_data[$color_product[$c]] = ['price' => $colorPrice[$c]];
            }
            $product->colors()->sync($sync_color_data);
        }


        if ($size_product) {

            $sync_size_data = [];
            for ($c = 0; $c < count($size_product); $c++) {
                if (json_decode($request->size_price)) {
                    $sizePrice = json_decode($request->size_price);
                } else {
                    $sizePrice = [$c => 0];
                }
                $sync_size_data[$size_product[$c]] = ['price' => $sizePrice[$c]];
            }
            $product->sizes()->sync($sync_size_data);
        }

        return ResponseJson('200', 'تم الحفظ بنجاح', $product);
    }


    public function statusUpdate(Request $request, $id)
    {
        $validator = validator()->make($request->all(), [
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return ResponseJson('0', $validator->errors()->first(), null);
        }

        $product = Product::where('id', $id)->first();
        $product->update([
            'status' => $request->status
        ]);
        return ResponseJson('200', 'تم تعديل حالة المنتج ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        RequestLog::create(['content' => $request->all(), 'service' => 'delete product']);

        $extra_product_delete = ExtraProduct::where('product_id', $id)->delete();

        $product = Product::where('id', $id)->first();
        $product->colors()->detach();
        $product->sizes()->detach();
        $product->delete();
        return ResponseJson('200', 'تم حذف المنتج ');
    }


    public function favorites(Request $request)
    {
        $validator = validator()->make($request->all(), [
            "product_id" => 'exists:products,id',
        ]);

        if ($validator->fails()) {
            return ResponseJson('0', $validator->errors()->first());
        }

        $client = $request->user();
        $favorites = $client->favourites()->toggle($request->product_id);

        return ResponseJson('200', 'تمت الإضافة الى التفضيلات ', $favorites);

    }

    public function myFavorites(Request $request)
    {
        $product = Auth::user()->favourites()->with('offers')->latest()->paginate();

        return ResponseJson('200', 'المنتجات المفضلة', $product);
    }

    public function reviews(Request $request)
    {

        $validator = validator()->make($request->all(), [
            "product_id" => 'required | exists:products,id',
            "rating" => 'required ',
            "comment" => 'required ',

        ], [

        ]);

        if ($validator->fails()) {
            return ResponseJson('0', $validator->errors()->first());
        }

        $client = $request->user();
        $client->reviews()->detach($request->product_id);
        $client->reviews()->attach([$request->product_id => [
            'comment' => $request->comment,
            'rating' => $request->rating,
        ]]);

        //  update rate of Product

        $rate_avg = Product::find($request->product_id)->reviews()->avg('rating');

        Product::find($request->product_id)->update(['rate' => $rate_avg]);

        return ResponseJson('200', 'تم تقيم المنتج ');

    }


    public function filter(Request $request)
    {
        $product = Product::with('store', 'offers')->WhereHas('store', function ($query) use ($request) {
            $query->where('active', 1);
        })->where('name', 'LIKE', '%' . $request->name . '%')->paginate();

        return ResponseJson('200', ' ناتج البحث عن ' . $request->name, $product);
    }



    public function searchItem(Request $request)
    {
        $product = Product::with( 'offers')->where('store_id',  $request->store_id)-> where('name', 'LIKE', '%' . $request->name . '%')->paginate();

        return ResponseJson('200', ' ناتج البحث عن ' . $request->name, $product);
    }


    public function addAttr(Request $request, $id)
    {

        try {
            $att = new ProductAttr();
            $att->product_id = $id;
            $att->title = $request->title;
            $att->type = $request->type;
            $att->plus = $request->plus;
            $att->status = $request->status;
            $att->save();

             $description  =  json_decode($request->description);
            for ($i = 0; $i < count($description); $i++) {
                $data[] = [
                    'product_attr_id' => $att->id,
                    'description' => $description[$i],
                    'price' => $request->price[$i],
                ];
            }
            ProductAttrItem::insert($data);

            return ResponseJson('200', 'تم الحفظ بنجاح', null);
        } catch (\Exception $ex) {
            return ResponseJson('0', 'حدث مشكله', null);

        }


    }

    public function activeAttr(Request $request, $id){
        $validator = validator()->make($request->all(), [
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return ResponseJson('0', $validator->errors()->first(), null);
        }

        $product = ProductAttr::where('id', $id)->first();

        if ($product){
            $product->update([
                'status' => $request->status
            ]);
        }else{
            return ResponseJson('404', 'تأكد من البيانات');
        }

        return ResponseJson('200', 'تم تعديل الحالة ');
    }

}

