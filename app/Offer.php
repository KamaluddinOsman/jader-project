<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{

    protected $table = 'offers';
    public $timestamps = true;
    protected $appends = ['favourite'];

    protected $fillable = array('product_id', 'image_license','name', 'desc', 'start', 'end', 'price', 'discount_value', 'status');

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function clients()
    {
        return $this->belongsToMany('App\Client');
    }

    public function getFavouriteAttribute($value)
    {
        if (request()->user()){
            $favourite = $this->whereHas('clients',function ($q) {
                $q->where('client_offer.client_id',request()->user()->id);
                $q->where('client_offer.offer_id',$this->id);
            })->first();

            $favourite = $favourite ? true : false;
            return $favourite;
        }else{
            return false;
        }
    }
}
