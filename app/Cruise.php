<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cruise extends Model
{

    protected $table = 'cruises';
    public $timestamps = true;
    protected $fillable = array('car_id', 'duration', 'starting_point', 'end_point', 'price', 'code', 'status');

    public function car()
    {
        return $this->belongsTo('\Car');
    }

    public function client()
    {
        return $this->belongsTo('Client');
    }

}
