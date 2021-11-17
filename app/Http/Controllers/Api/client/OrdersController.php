<?php

namespace App\Http\Controllers\Api\client;


use App\Cart;
use App\Favorite;
use App\Order;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return PorductResource
     */
    public function index(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'type' => 'required|in:0,1',
        ]);

        if ($validator->fails()) {
            return ResponseJson('0', $validator->errors()->first(),  null);
        }

        $product = Product::where('type', $request->type);

        if ($request->category_id){
            $product = $product->where('category_id',$request->category_id);
        }elseif ($request->store_id){
            $product = $product->where('store_id',$request->store_id);
        }

        $product = $product->WhereHas('store', function ($query) {
            $query->where('active', '1');
        })->paginate();

        if ($product) {
            return ResponseJson('200', 'كل البيانات', $product);
        } else {
            return ResponseJson('0', 'لا يوجد اى  بيانات ');
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

        $validator = validator()->make($request->all(), [
            'product_id' => 'required|int|exists:products,id',
        ]);

        if ($validator->fails()) {
            return ResponseJson('0', $validator->errors()->first(),  null);
        }

        //if there is not quantity requested, the value is 1 as defect
        $quantity = $request->quantity ? $request->quantity : 1;

        $user = \Auth::user();
        $product = $request->product_id;
        if ($user) {
            $cart = Cart::where('client_id',$user->id)->where('product_id',$product)->first();
            if ($cart){
                $cart = $cart->update([
                    'quantity' => $quantity,
                ]);
            }else{
                $cart = Cart::create([
                    'product_id' => $product,
                    'quantity' => $quantity,
                    'client_id' => $user->id,
                ]);
            }

        }

        return ResponseJson('200', 'تم الحفظ بنجاح', $cart);



        //checking if the user is logged
//        if ($user) {
//            $basicCart = Order::where('type' ,$request->type)->where('client_id', $user->id)->first();
//
//            if (!$basicCart) {   //لو الاوردر دا مش موجدود
//                $basicCart = new Order();
//                $basicCart->client_id       = $user->id;
//                $basicCart->store_id    = $user->store_id;
//                $basicCart->type            = $request->type;
//                $basicCart->description     = $request->description;
//                $basicCart->price           = $request->price;
//                $basicCart->quantity        = $request->quantity;
//                $basicCart->delivery_date   = $request->delivery_date;
//                $basicCart->rate            = $request->rate;
//                $basicCart->rate_comment    = $request->rate_comment;
//                $basicCart->save();
//
//                $basicCart->products()->attach( $request->product_id,[
//                        'quantity'   => $quantity
//                ]);
//
//            }else{  // لو الاوردر دا موجود
//                foreach ($basicCart->products as $product){
//                    if ($product->pivot->product_id == $request->product_id){
//                        $basicCart->products()->updateExistingPivot( $request->product_id,[
//                            'quantity'   => $quantity
//                        ]);
//                    }else{
//                        $basicCart->products()->attach( $request->product_id,[
//                            'quantity'   => $quantity
//                        ]);
//                    }
//                }
//
//
//
//            }
//
//
//
//            return ResponseJson('200', 'تم الحفظ بنجاح', $basicCart);
//       }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $product = product::findOrFail($id);
        $product = [
            'id'    =>  $product->id,
            'store_id'    =>  $product->store_id,
            'varieties_id'    =>  $product->varieties_id,
            'category_id'    =>  $product->category_id,
            'brands_id'    =>  $product->brands_id,
            'name'    =>  $product->name,
            'rate'    =>  $product->rate,
            'price'    =>  $product->price,
            'code'    =>  $product->code,
            'quantity'    =>  $product->quantity,
            'notes'    =>  $product->notes,
            'created_at'    =>  $product->created_at,
            'updated_at'    =>  $product->updated_at,
            'favourite'    =>  $product->favourite,
            'image' => [
                $product->image1 = $product->image1,
                $product->image2 = $product->image2,
                $product->image3 = $product->image3,
                $product->image4 = $product->image4,
            ]
        ];

        if ($product) {
            return ResponseJson('200', 'المنتج', $product);
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
    public function update(Request $request,$id)
    {
        $product   = Product::findOrFail($id);
        $product->update($request->all());
        if ($request->hasFile('image1')) {

            File::delete('storage/images/product/' . $product->image1);

            $image_tmp = Input::file('image1');
            if ($image_tmp->isValid()) {
                $filename = time() . '.' . $image_tmp->getClientOriginalExtension();
                $path = public_path('storage/images/product/' . $filename);
                $global = config('constants.image_Url');
                $url = $global . 'product/' . $filename;
                Image::make($image_tmp->getRealPath())->resize(468, 249)->save($path);
                $product->image1 = $url;
            }
        }

        if ($request->hasFile('image2')) {

            File::delete('storage/images/product/' . $product->image2);

            $image_tmp = Input::file('image2');
            if ($image_tmp->isValid()) {
                $filename = time() . '.' . $image_tmp->getClientOriginalExtension();
                $path = public_path('storage/images/product/' . $filename);
                $global = config('constants.image_Url');
                $url = $global . 'product/' . $filename;
                Image::make($image_tmp->getRealPath())->resize(468, 249)->save($path);
                $product->image2 = $url;
            }
        }

        if ($request->hasFile('image3')) {

            File::delete('storage/images/product/' . $product->image3);

            $image_tmp = Input::file('image1');
            if ($image_tmp->isValid()) {
                $filename = time() . '.' . $image_tmp->getClientOriginalExtension();
                $path = public_path('storage/images/product/' . $filename);
                $global = config('constants.image_Url');
                $url = $global . 'product/' . $filename;
                Image::make($image_tmp->getRealPath())->resize(468, 249)->save($path);
                $product->image3 = $url;
            }
        }

        if ($request->hasFile('image4')) {

            File::delete('storage/images/product/' . $product->image4);

            $image_tmp = Input::file('image4');
            if ($image_tmp->isValid()) {
                $filename = time() . '.' . $image_tmp->getClientOriginalExtension();
                $path = public_path('storage/images/product/' . $filename);
                $global = config('constants.image_Url');
                $url = $global . 'product/' . $filename;
                Image::make($image_tmp->getRealPath())->resize(468, 249)->save($path);
                $product->image4 = $url;
            }
        }
        $product->save();
        $product->colors()->sync((array) $request->input('color_product'));
        $product->sizes()->sync((array) $request->input('size_product'));
        $product->image1 = $product->image1;
        $product->image2 = $product->image2;
        $product->image3 = $product->image3;
        $product->image4 = $product->image4;
        return ResponseJson('200', 'تم الحفظ بنجاح', $product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(Request $request,$id)
    {
        $product = Product::where('id',$id)->first();
        $product->colors()->detach();
        $product->sizes()->detach();
        $product->delete();
        return ResponseJson('200','تم حذف المنتج ');
    }

    public function invoiceImage(Request $request, $id) {
        $validator = validator()->make($request->all(), [
        'invoice_image' => 'required|mimes:jpeg,jpg,png',
        ]);

        if ($validator->fails()) {
            return ResponseJson('0', $validator->errors()->first(), null);
        }

        $order = Order::where('id', $id)->first();
        if ($file = $request->file('invoice_image')) {
            $order->invoice_image = uploadImage($file, 'order');
        }
        $order->save();

        return ResponseJson('200','تم اضافة صوره الفاتوره بنجاح ');

    }
}
