<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnitColor extends Model
{

    protected $table = 'unit_colors';
    public $timestamps = true;
    protected $fillable = array('category_id', 'name', 'code', 'type');

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function productColors()
    {
        return $this->belongsToMany('App\Product');
    }

    public function productSizes()
    {
        return $this->belongsToMany('App\Product');
    }


}
