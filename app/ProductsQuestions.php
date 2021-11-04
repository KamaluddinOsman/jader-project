<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductsQuestions extends Model
{
    protected $fillable = array('product_id', 'question', 'answer');

    public function product() {
        return $this->belongsTo('App\Product');
    }

    protected $casts = [
        'answer' => 'array',
    ];

    public function answers() {
        return $this->hasMany('App\ProductsAnswers');
    }
}
