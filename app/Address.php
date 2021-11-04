<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'addresses';
    public $timestamps = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'title',
        'client_id',
        'descrption',
        'lang',
        'late',
        'city',
        'state',
        'default',
    ];

}
