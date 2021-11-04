<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{

    protected $table = 'cars';
    public $timestamps = true;
    protected $fillable = array('client_id', 'Type_car', 'number', 'personal_image','driver_license', 'car_license', 'personal_id', 'car_model', 'image_car_front', 'image_car_back','brand_car', 'activated', 'lang', 'late', 'stc_pay', 'char_car', 'name_card', 'ipan', 'transfer_method', 'bank_name', 'status', 'nationality_id', 'date_of_birth', 'gender');

    public function getPersonalIdAttribute($value)
    {
        return url()->previous().'/'.$value;
    }

    public function getDriverLicenseAttribute($value)
    {
        return url()->previous().'/'.$value;
    }

    public function getCarLicenseAttribute($value)
    {
        return url()->previous().'/'.$value;
    }

    public function getImageCarFrontAttribute($value)
    {
        return url()->previous().'/'.$value;
    }

    public function getImageCarBackAttribute($value)
    {
        return url()->previous().'/'.$value;
    }

    public function getPersonalImageAttribute($value)
    {
        return url()->previous().'/'.$value;
    }

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function cruises()
    {
        return $this->hasMany('App\Cruise');
    }

    public function brand()
    {
        return $this->belongsTo('App\Brand');
    }

}
