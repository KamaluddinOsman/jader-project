<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{

    protected $table = 'banners';
    public $timestamps = true;
    protected $fillable = array('title', 'image','description' , 'active');

    public function getImageAttribute($value)
    {
        return url()->previous().'/'.$value;
    }
}
