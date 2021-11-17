<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductAttrItem extends Model
{
    protected $fillable = array('product_attr_id', 'description', 'price');

    public function ProductAttr() {
        return $this->belongsTo('App\ProductAttr');
    }

}
