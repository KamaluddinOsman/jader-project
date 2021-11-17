<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductsAnswers extends Model
{
    protected $fillable = array('question_id', 'answer');

    public function questions() {
        return $this->belongsTo('App\ProductsQuestions');
    }
}
