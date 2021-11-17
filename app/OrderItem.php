<?php

namespace App;

use App\Address;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\ProductsController as ProductsController;
use App\Http\Controllers\UserController as UserController;
use App\Log;
use App\Notice;
use App\Product;
use App\VirtualProduct;
use App\VirtualProductOrder;
use Illuminate\Support\Facades\Mail;

class OrderItem extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'order_items';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'product_id',
        'store_id',
        'price',
        'original_price',
        'quantity',
        'discount',
        'status',
        'delivery_date',
        'rate',
        'rate_comment',

    ];


	public function order()
    {
        return $this->belongsTo('App\Order');
    }

    public function store()
    {
        return $this->belongsTo('App\Store');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function size()
    {
        return $this->belongsTo('App\UnitColor', 'size_id');
    }


}
