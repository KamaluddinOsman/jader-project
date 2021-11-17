<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{

    protected $table = 'tickets';
    public $timestamps = true;
    protected $fillable = [
        'user_id', 'number', 'title','type', 'image' , 'message', 'status'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
