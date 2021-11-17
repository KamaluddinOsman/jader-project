<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;


class MoneyAccount extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'money_accounts';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'client_id',
        'order_id',
        'product_id',
        'store_id',
        'client_money',
        'site_money',
        'total_money',
        'status',
        'transfer_Number',
        'image',

    ];


    public function user() {
        return $this->belongsTo('App\User');
    }

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function order()
    {
        return $this->belongsTo('App\Order');
    }

    public function store()
    {
        return $this->belongsTo('App\Store');
    }

    public function car()
    {
        return $this->belongsTo('App\Car');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }


    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    }

    public function getUpdatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    }


}
