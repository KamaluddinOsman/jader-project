<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Variety extends Model
{

    protected $table = 'varieties';
    public $timestamps = true;
    protected $fillable = array('name','category_id', 'activated');
//    protected $visible = array('category_id');

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function products()
    {
        return $this->hasMany('App\Product');
    }

}
