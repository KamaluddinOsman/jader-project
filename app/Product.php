<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{

    protected $table = 'products';
    public $timestamps = true;
    protected $appends = ['favourite', 'offer', 'cart'];

    // public function getImage1Attribute($value)
    // {
    //     return url()->previous().'/'.$value;
    // }

    // public function getImage2Attribute($value)
    // {
    //     return url()->previous().'/'.$value;
    // }

    // public function getImage3Attribute($value)
    // {
    //     return url()->previous().'/'.$value;
    // }

    // public function getImage4Attribute($value)
    // {
    //     return url()->previous().'/'.$value;
    // }
    protected $fillable = array('store_id', 'calories', 'spacialCategory_id', 'brands_id', 'name', 'rate', 'code' , 'price' , 'quantity', 'notes', 'image1', 'image2', 'image3', 'image4', 'type', 'rest_quantity', 'status');

    public function store()
    {
        return $this->belongsTo('App\Store');
    }

    public function spacialCategory()
    {
        return $this->belongsTo('App\SpacialCategory','spacialCategory_id', 'id')->where('status', '=', 1);
    }



    public function product()
    {
        return $this->belongsTo('App\SpacialCategory','spacialCategory_id', 'id');
    }

    public function brand()
    {
        return $this->belongsTo('App\Brand','brands_id');
    }

    public function colors()
    {
        return $this->belongsToMany('App\UnitColor','color_product','product_id','color_id')->withPivot('price');

    }

    public function sizes()
    {
        return $this->belongsToMany('App\UnitColor','size_product','product_id','size_id')->withPivot('price');

    }

    public function offers()
    {
        return $this->hasOne('App\Offer')->where('end','>=' , Carbon::today())->where('status', '==', 1);
    }

    public function clients()
    {
        return $this->belongsToMany('App\Client','cart', 'product_id','client_id');
    }

    public function orders()
    {
        return $this->belongsToMany('App\Order','order_items','id','product_id	');
    }

    public function reviews()
    {
        return $this->belongsToMany('App\Client','product_reviews')->withPivot('rating','comment');
    }

    public function favourites()
    {
        return $this->belongsToMany('App\Client','client_product', 'product_id','client_id');
    }


    public function ProductAttr() {
        return $this->hasMany('App\ProductAttr', 'product_id', 'id')->with('ProductAttrItem');
    }

    public function ProductAttrActive() {
        return $this->hasMany('App\ProductAttr', 'product_id', 'id')->where('status', '=', 1)->with('ProductAttrItem');
    }

    public function getFavouriteAttribute($value)
    {
        $client = auth('client')->user();
        if ($client){
            $favourite = $this->whereHas('favourites',function ($q) use ($client){
                $q->where('client_id',$client->id);
                $q->where('product_id',$this->id);
            })->first();

            $favourite = $favourite ? true : false;
            return $favourite;
        }else{
            return false;
        }
    }

    public function getCartAttribute($value)
    {
        $client = auth('client')->user();
        if ($client){
            $cart = $this->whereHas('clients',function ($q)  use ($client){
                $q->where('cart.client_id',$client->id);
                $q->where('cart.product_id',$this->id);
            })->first();

            $cart = $cart ? true : false;
            return $cart;
        }else{
            return false;
        }
    }

    public function getOfferAttribute($value)
    {
        $offer = $this->whereHas('offers',function ($q) {
            $q->where('offers.product_id',$this->id);
            $q->where('offers.status', '==', 1);
            $q->where('offers.end', '>=' , Carbon::today());

        })->first();

        $offer = $offer ? true : false;
        return $offer;

    }

}
