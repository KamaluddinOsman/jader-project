<?php

namespace App\Http\Controllers\Api\client;


use App\Address;
use App\Car;
use App\Cart;
use App\DeliveryCost;
use App\ExtraProduct;
use App\Favorite;
use App\Product;
use App\ProductAttrItem;
use App\ProductsQuestions;
use App\RequestLog;
use App\Store;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartsController extends Controller
{

    public function index(Request $request)
    {
        $user = Auth::user();


        $carts = Cart::with('size', 'color')->where('client_id',$user->id)->get();


        $address = Address::where('id', $request->address_id)->first();


        if (!$address){
            return ResponseJson('0', 'تأكد من البيانات', null);
        }

        if (empty(count($carts))){
            return ResponseJson('0', 'لايوجد بيانات', null);
        }


        $cart = [];
        $productAttrItem = [];


        $clientDis     = $address->late.','.$address->lang;
        $storeDis      = $carts[0]->store->late.','.$carts[0]->store->lang;
        
        


        $distance = getMoreDistance($clientDis, $storeDis, true, true );
         
             

    //   return ResponseJson('0', '  ', $distance);

    if(!$distance){
          return ResponseJson('0', 'هذه المسافه اكبر من النطاق المتاح'  , null);
        }
   
        $a = (int)round($distance['distance']);
        
        $deliveryCost = DeliveryCost::where('from_k', '<=', $a)->where('to_k', '>=', $a)->where('type_car', $request->type_car)->first();
          if(!$deliveryCost){
            return ResponseJson('0', 'عذراً حدث مشكلة نأسف لك بسبب لايوجد تكلفه معرفه للمسافه هذه او غير مدعومه', null);
        }

        $sippingPrice = collect([$deliveryCost->from_price, $deliveryCost->to_price])->avg();


        $distanceAndPrice  = [
            'distance' => $distance['distance'],
            'duration' => $distance['duration'],
            'totalCart' => $carts->sum('total_price'),
            'deliveryCost' => $sippingPrice,
            'store_name' => $carts[0]->store->name,
            'store_logo' => $carts[0]->store->logo,
        ];


        foreach ($carts as $row){

            $product = Product::where('id', $row->product_id)->first();

            $choices = [];
            if ($row->product_attr) {
                $ids = json_decode(json_decode($row->product_attr));
       
             
                $productschoices = ProductAttrItem::whereIn('id', $ids)->with('ProductAttr')->get();
                foreach ($productschoices as $choice) {
                    $choices[$choice->product_attr_id]['id'] = $choice->product_attr_id;
                    $choices[$choice->product_attr_id]['title'] = $choice->ProductAttr->title;
                    $choices[$choice->product_attr_id]['description'][] = $choice->description;
                }
            }

            $cart[$row->id]['product_id'] = $product->id;
            $cart[$row->id]['cart_id'] = $row->id;
            $cart[$row->id]['name_product'] = $product->name;
            $cart[$row->id]['qty'] = $row->quantity;
            $cart[$row->id]['total_price'] = $row->total_price;
            $cart[$row->id]['size'] = $row->size->name ?? '';
            $cart[$row->id]['color'] = $row->color->name ?? '';
            $cart[$row->id]['attr_product'] = array_values($choices);

        }

        $data = [
            'cart' => array_values((array) $cart),
            'details' => $distanceAndPrice,
        ];

        $count = $carts->count();
        return ResponseJson('200', 'عربة مشترياتك', $data, $count);

    }

    public function store(Request $request)
    {

        RequestLog::create(['content' => $request->all(), 'service' => 'store_cart']);

        $product = $request->product_id;
        $item = Product::where('id',$product)->first();
        $user = \Auth::user();

        if(!$item){
            return ResponseJson('0', 'هذا المنتج ليس موجود');
        }
        $store = Store::where('id', $item->store_id)->first();

        $cart = Cart::where('client_id', $user->id)->first();

        if ($cart){
            if ($cart->store_id !== $item->store_id){
                return ResponseJson('0', 'عفوا لا يمكنك وضع هذا المتتج فى عربتك لا يمكنك الطلب الا من منشأه واحده فى الاوردر');
            }
        }


        // if ($store){
        //     if ($store->open() == 0){
        //         return ResponseJson('0', 'عفوا لا يمكنك وضع هذا المتتج فى عربتك لأن المنشأه مغلقة الأن ');
        //     }

        //     if ($store->open() == 2){
        //         return ResponseJson('0', 'عفوا لا يمكنك وضع هذا المتتج فى عربتك لأن المنشأه غير متاحة الأن ');
        //     }
        // }
       
        $validator = validator()->make($request->all(), [
            'product_id' => 'required|int|exists:products,id',
        ]);

        if ($validator->fails()) {
            return ResponseJson('0', $validator->errors()->first(),  null);
        }

        //if there is not quantity requested, the value is 1 as defect
        $quantity = $request->quantity ? $request->quantity : 1;

        $endOffer = null;
        $total = $request->price;


        if ($request->product_attr == null){
            $product_attr = '';
        }else{
            $product_attr = json_encode($request->product_attr);
        }




        if ($user) {

            if (!$item->offers) {
                $discount = 0;
            } else {
                $discount = $item->offers->discount;
            }

            $cart = Cart::create([
                'product_id' => $product,
                'store_id' => $item->store_id,
                'quantity' => $quantity,
                'total_price' => $total,
                'product_attr' => $product_attr,
                'client_id' => $user->id,
                'original_price' => $item->price,
                'discount' => $discount,
                'color_id' => $request->color_id,
                'size_id' => $request->size_id,
                'end_offer' => $endOffer ?? null,
            ]);

        }
        return ResponseJson('200', 'تم اضافة المنتج فى عربة مشترياتك ', $cart);

    }

    public function destroy(Request $request,$id)
    {
        RequestLog::create(['content' => $request->all(), 'service' => 'delete_cart']);

        $cart = Cart::where('id',$id)->where('client_id', Auth::id())->first();

        if ($cart){
            $cart->delete();
            return ResponseJson('200','تم حذف المنتج من عربة مشترياتك ');
        }else{
            return ResponseJson('0','حدث مشكله عند حذف المنتج من عربة مشترياتك ');
        }
    }

    public function cartCount(Request $request){
        $client = Auth::id();
        $value_added_tax = settings()->value_added_tax;  //القيمه المضافة
        $count = Cart::where('client_id', $client)->sum('quantity');
        return ResponseJson('200', 'عدد المنتجات فى عربة المشتريات', $value_added_tax, $count);
    }
}
