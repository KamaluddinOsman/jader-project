<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{

    protected $table = 'token';
    public $timestamps = true;
    protected $fillable = array('tokntable_id', 'tokntable_type', 'platform','token');

    public function client()
    {
        return $this->morphTo();
    }
}
