<?php

namespace App\Http\Controllers\Api\client;

use App\Cart;
use App\Events\NewNotification;
use App\Notifications\NewOfferNotification;
use App\Notifications\NewStoreNotification;
use App\Offer;
use App\Product;
use App\RequestLog;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Resources\Product as PorductResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Image;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return PorductResource
     */
    public function index(Request $request)
    {
        $offer = Offer::with('product')
            ->where('end' , '>=' , Carbon::today())->orderByRaw('created_at')
            ->where('status', '==', 1)
            ->whereHas('product' ,function ($q) use ($request){
                if ($request->category_id) {
                    $q->where('category_id',$request->category_id);
                }elseif ($request->store_id){
                    $q->where('store_id',$request->store_id);
                }
            });
        $offer = $offer->paginate();
        $global = config('constants.Url');
        foreach($offer as $Url){
            $Url->image = $global.$Url->image;
        }
        if ($offer) {
            return ResponseJson('200', 'كل البيانات', $offer);
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
        RequestLog::create(['content' => $request->all(), 'service' => 'store Offer']);

        $validator = validator()->make($request->all(), [
            'product_id'     => 'required|int|exists:products,id',
            'name'           => 'required',
            'desc'           => 'required',
            'discount_value' => 'required',
            'start'          => 'required|before:end',
            'end'            => 'required|after:start',
        ]);

        if ($validator->fails()) {
            return ResponseJson('0', $validator->errors()->first(),  null);
        }

        $price = Product::where('id',$request->product_id)->first()->price;
        $disc = ($price * $request->discount_value /100);
        $priceAfterDisc = $price - $disc;
        $offer = new Offer();
        $offer->product_id        = $request->product_id;
        $offer->name              = $request->name;
        $offer->desc              = $request->desc;
        $offer->discount_value    = $request->discount_value;
        $offer->discount          = $disc;
        $offer->price             = $priceAfterDisc;
        $offer->start             = $request->start;
        $offer->end               = $request->end;
        $offer->status            = 0;

        if($file = $request->file( 'image_license')) {
            $offer->image_license = uploadImage($file,'offer');
        }

        $offer->save();

        $admin = User::all();
        \Illuminate\Support\Facades\Notification::send($admin, new NewOfferNotification($offer));

        $data = [
            'info'  => $offer,
            'type'  => 'newOffer'
        ];
        event(new NewNotification($data));

        return ResponseJson('200', 'تم الحفظ بنجاح', $offer);

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {

        $offer = Offer::with('product')->findOrFail($id);
        $global = config('constants.Url');
        $offer->image = $global.$offer->image;

        if ($offer) {
            return ResponseJson('200', 'العرض', $offer);
        } else {
            return ResponseJson('0', 'لا يوجد هذا العرض ');
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
        RequestLog::create(['content' => $request->all(), 'service' => 'update Offer']);

        $offer   = Offer::findOrFail($id);

        $offer->update($request->all());

        Cart::where('product_id', $request->product_id)->update(['end_offer'=> $request->end]);

        return ResponseJson('200', 'تم الحفظ بنجاح', $offer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(Request $request,$id)
    {
        RequestLog::create(['content' => $request->all(), 'service' => 'delete Offer']);

        $offer = Offer::where('id',$id)->first();
        $offer->delete();
        return ResponseJson('200','تم حذف المنتج ');
    }

    public function favorites(Request $request){

        RequestLog::create(['content' => $request->all(), 'service' => 'add favorites Offer']);

        $validator = validator()->make($request->all(),[
            "offer_id"     => 'exists:products,id' ,
        ]);

        if ($validator->fails())
        {
            return ResponseJson('0',$validator->errors()->first());
        }

        $client = $request->user();
        $favorites = $client->offers()->toggle($request->offer_id);

        return ResponseJson('1','تمت الإضافة الى التفضيلات ',$favorites);
    }

    public function myFavorites(Request $request){
        $offer = $request->user()->offers()->latest()->paginate(20);
        return ResponseJson('1','العروض المفضلة',$offer);
    }


    public function deleteEndOffer()
    {
        Offer::whereDate('end' , '<', Carbon::today()->toDateString() )->delete();
        return ResponseJson('200','تم حذف المنتج ');
    }

}
