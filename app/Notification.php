<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    protected $table = 'notifications';
    public $incrementing = false;
    public $timestamps = true;
    protected $fillable = array('notifiable_id', 'notifiable_type', 'order_id', 'title', 'body', 'read', 'type', 'id');

    public function clients()
    {
        return $this->morphTo();
    }

    public function stores()
    {
        return $this->morphTo();
    }

    public function order()
    {
        return $this->belongsTo('App\Order');
    }

}
