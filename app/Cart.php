<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{

    protected $table = 'cart';
    public $timestamps = true;
    protected $fillable = array('client_id','store_id','product_id','size_id','color_id' ,'product_attr' ,'quantity','total_price','original_price','discount', 'end_offer');
    protected $casts = [
        "original_price" => "double(8,2)",
        "total_price" => "double(8,2)",
    ];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function store()
    {
        return $this->belongsTo('App\Store');
    }

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function size()
    {
        return $this->belongsTo('App\UnitColor', 'size_id', 'id');
    }

    public function color()
    {
        return $this->belongsTo('App\UnitColor', 'color_id', 'id');
    }



}
