<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryCost extends Model
{

    protected $table = 'delivers_costs';
    public $timestamps = true;
    protected $fillable = array('from_k', 'to_k', 'from_price', 'to_price', 'type_car');

}
