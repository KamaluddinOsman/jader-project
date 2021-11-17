<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class ClientLogin  extends Authenticatable
{
    use Notifiable;
    protected $fillable =
['first_name', 'last_name', 'full_name' ,'email','image', 'phone', 'gender', 'activated', 'password', 'api_token', 'verification_code', 'district_id', 'provider', 'provider_id', 'late', 'lang'];


    protected $hidden = ['district_id ', 'password','remember_token'];
}
