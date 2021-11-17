<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{

    protected $table = 'brands';
    public $timestamps = true;
    protected $fillable = array('name');

    public function products()
    {
        return $this->hasMany('App\Product');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

}
