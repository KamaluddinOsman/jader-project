<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExtraProduct extends Model
{
    protected $fillable = ['product_id', 'name', 'price', 'type'];
}
