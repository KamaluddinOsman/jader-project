<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class RequestLog extends Model
{

    protected $table = 'logs';
    public $timestamps = true;
    protected $fillable = array('content', 'service');

	public function setContentAttribute($value)
    {
        $this->attributes['content'] = json_encode($value);
    }

    public function setServiceAttribute($value){
        if (Auth::user()){
            $this->attributes['service'] =  ' قام ' . Auth::user()->name.  ' ' . $value;
        }else{
            $this->attributes['service'] = $value;
        }
    }

    public function getContentAttribute($value)
    {
        return json_decode($value);
    }

}
