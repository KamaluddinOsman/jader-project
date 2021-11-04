<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductAttr extends Model
{
    protected $fillable = array('id', 'product_id', 'plus', 'title', 'type', 'status');

    public function ProductAttrItem() {
        return $this->hasMany('App\ProductAttrItem', 'product_attr_id', 'id');
    }
}
