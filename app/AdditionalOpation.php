<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdditionalOpation extends Model
{
   
    protected $table = 'additonal_option';
    public $timestamps = false;
    protected $fillable = array('att_id', 'name', 'price');

   
}
