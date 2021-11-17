<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

    protected $table = 'settings';
    public $timestamps = true;
    protected $fillable = array('name', 'About', 'commission', 'phone', 'site', 'facebook', 'logo', 'FIREBASE_API_KEY', 'JWT_SECRET', 'GOOGLE_API', 'FACEBOOK_APP_ID', 'FACEBOOK_APP_SECRET', 'sms_USERNAME', 'sms_SENDER', 'sms_URL','publishable_api_key', 'normal_ratio', 'zero_ratio', 'platinum_ratio', 'silver_ratio', 'golden_ratio', 'massey_ratio');

}
