<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{

    protected $table = 'bank_accounts';
    public $timestamps = true;
    protected $fillable = array('client_id', 'credit_card_num', 'ipan', 'year', 'month', 'nameCard');

    public function client()
    {
        return $this->belongsTo('App\Client');
    }
}
