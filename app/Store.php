<?php

namespace App;

use http\Env\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class Store extends Model
{

    protected $table = 'stores';
    public $timestamps = true;
    protected $fillable = array('created_at', 'client_id', 'city_id', 'category_id', 'logo', 'cover', 'front_img','name', 'phone1', 'phone2', 'company_register','num_tax', 'address', 'lang','late', 'about', 'minimum_order', 'delivery_price', 'whatsapp', 'facebook', 'site', 'active', 'name_responsible', 'responsible_position', 'responsible_mobile', 'name_authorized', 'authorized_mobile', 'legal_name', 'picture_contract', 'email', 'start_time', 'end_time', 'day_work', 'name_card', 'ipan', 'bank_name', 'ratio', 'status', 'delivery_limit', 'delivery_service', 'order_processing_time');
    /**
     * @var mixed
     */

    public function getDayWorkAttribute($value)
    {
        return $value;
    }

    public function open(){
        $startWork = $this->start_time;
        $endWork = $this->end_time;

        $dayJson =  json_decode($this->day_work);
        $dayNow = new \Carbon\Carbon(now());
        $dayName = $dayNow->dayName;
        $names = [];

        if(!empty($dayJson)) {
            foreach ($dayJson as $key => $value) {
                array_push($names, $value);
            }
        }


        if(in_array($dayName, $names))
        {
            if(now() < $endWork && now() > $startWork){
                return 1;
            }elseif ($this->status == 'close' || now() > $endWork) {
                return  0;
            }elseif ($this->status == 'open' && now() < $endWork && now() < $startWork){
                return 1;
            }elseif($this->status == 'busy'){
                return 2;
            }
        }else{
            return 0;
        }

    }


    public function Distance($address , $car)
    {
        $address = Address::where('id', $address)->first();
        $clientDis     = $address->late.','.$address->lang;
        $storeDis     = $this->late.','.$this->lang;

        $distance = getMoreDistance($clientDis, $storeDis, true, true );
        $a = (int)round($distance['distance']);
        $deliveryCost = DeliveryCost::where('from_k', '<=', $a)->where('to_k', '>=', $a)->where('type_car', $car)->first();

        $distanceAndPrice  = [
            'distance' => $distance['distance'],
            'duration' => $distance['duration'],
            'deliveryCost' => $deliveryCost,
        ];

        return $distanceAndPrice;
    }

//    public function ActiveDay(){
//       $data= collect(json_decode($this->day_work));
//        $filtered = $data->filter(function ($value, $key) {
//            return $value == 1 ;
//        });
//
//        return $filtered;
//	}

    public function getLogoAttribute($value)
    {
        return url()->previous().'/'.$value;
    }

    public function getFrontImgAttribute($value)
    {
        return url()->previous().'/'.$value;
    }

    public function getCoverAttribute($value)
    {
        return url()->previous().'/'.$value;
    }

    public function getPictureContractAttribute($value)
    {
        return url()->previous().'/'.$value;
    }

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function city()
    {
        return $this->belongsTo('App\City');
    }

    public function products()
    {
        return $this->hasMany('App\Product');
    }

    public function notifications()
    {
        return $this->morphMany('App\Notification', 'notifiable');
    }

    public function tokens()
    {
        return $this->morphMany('App\Token', 'tokntable');
    }

    public function Active()
    {
        return $this->where('active', 1)->get();
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_store');
    }

    public function spacialCategory()
    {
        return $this->hasMany('App\SpacialCategory')->where('status', '=', 1);
    }

}
