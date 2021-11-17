<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DriversRequests extends Model
{

    protected $table = 'drivers_requests';
    public $timestamps = true;
    protected $fillable = array('client_id', 'car_id', 'address_id', 'order_id', 'price','created_at');

    public function clients()
    {
        return $this->hasMany('App\Client');
    }

    public function order()
    {
        return $this->belongsTo('App\Order');
    }

//    public function car()
//    {
//        return $this->hasMany('App\Car','id','car_id');
//    }

    public function car()
    {
        return $this->belongsTo('App\Car');
    }

    public function address()
    {
        return $this->belongsTo('App\Address');
    }

}
