<?php

namespace App\Http\Controllers\Vendors;

use App\Http\Controllers\Controller;

use App\Http\Requests\ProductRequest;
use App\Models\Image;
use App\Models\ProductImage;
use App\Models\SubCategories;
use App\Notifications\VendorCreated;
use App\Product;
use App\SpacialCategory;
use App\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;


class ProductController extends Controller
{
   public function index(){
       $user = auth()->user();

       $store = Store::where('client_id',$user->id)->pluck('active')->first();
       $products = Product::where("store_id",   $store)->paginate(PAGINATION_COUNT_VENDOR);
       return view('vendors.product.index', compact('products'));
   }



    public function create()
    {
        $user = auth()->user();
        $store = Store::where('client_id', $user->id)->pluck('active')->first();

        $categories = SpacialCategory::where('store_id', $store)->get();
        return view('vendors.product.create',compact('categories'));
    }

    public function store(Request  $request)
    {

        $user = auth()->user();

        $store = Store::where('client_id', $user->id)->pluck('active')->first();

            try{

                $records = new Product();
                $records->store_id = $store;
                $records->spacialCategory_id =1;
                $records->type ='1';
                $records->brands_id = 1;
                $records->name =$request['name'];
                $records->notes = $request['notes'];
                $records->status = 1;
                $records->quantity = 56;
                $records->price = $request['price'];
                $records->calories ="er";
                $records->status = 1;
                $records->code = 1;
                $records->rest_quantity = 1;

                if ($file = $request->file('image1')) {
                    $records->image1 = uploadImage($file, 'product');
                }

                if ($file = $request->file('image2')) {
                    $records->image2 = uploadImage($file, 'product');
                }

                if ($file = $request->file('image3')) {
                    $records->image3 = uploadImage($file, 'product');
                }

                $records->save();





                return redirect()->route('vendors.product')->with(['success' => 'تم الحفظ بنجاح']);


//                return redirect()->route('vendors.product')->with(['success' => 'بعض الخقول فارغه']);
            }
            catch(Exception $e){
                return  $e;
            }
        }



    public function update($id, ProductRequest $request)
    {

        try {

            $product = Product::Selection()->find($id);


            if (!$product)
                return redirect()->route('vendors.product')->with(['error' => 'هذا المنتج غير موجود او ربما يكون محذوفا ']);


            DB::beginTransaction();
//            //photo

//            $data = $request->except('_token', 'id' );
//
//
//            Product::where('id', $id)
//                ->update(
//                    $data
//                );


            Product::where('id', $id)
                ->update([
                    'productName' => $product['productName'],
                    'productDescription' => $product['productDescription'],
                ]);

            DB::commit();
            return redirect()->route('vendors.product')->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $exception) {
            return $exception;
            DB::rollback();
            return redirect()->route('vendors.product')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }


    public function  edit($id){
        try {
            $user = auth()->user();
            $store = Store::where('client_id', $user->id)->pluck('active')->first();
            $product =  Product::alls()->find($id);
            if (!$product)
                return redirect()->route('vendors.product')->with(['error' => 'هذا المنتج غير موجود او ربما يكون محذوفا ']);
            DB::beginTransaction();
            $categories =SpacialCategory::where("store_id",   $store)->get();
            return view('vendors.product.edit', compact('product','categories'));

        } catch (\Exception $exception) {
            return redirect()->route('vendors.product')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }


    }




}
