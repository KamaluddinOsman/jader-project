<?php

namespace App;

use App\Address;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\ProductsController as ProductsController;
use App\Http\Controllers\UserController as UserController;
use App\Log;
use App\Notice;
use App\Product;
use App\VirtualProduct;
use App\VirtualProductOrder;
use Illuminate\Support\Facades\Mail;

class Order extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'orders';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id',
        'type',
        'car_id',
        'store_id',
        'description',
        'end_date',
        'quantity',
        'delivery_date',
        'rate',
        'rate_comment',
        'code_delivered',
        'invoice_image',
        'created_at'
    ];
    /**
     * @var mixed
     */

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function address()
    {
        return $this->belongsTo('App\Address');
    }

    public function car()
    {
        return $this->belongsTo('App\Car');
    }

    public function store()
    {
        return $this->belongsTo('App\Store');
    }

    public function items()
    {
        return$this->hasMany('App\OrderItem');
    }

    public function products()
    {
        return $this->belongsToMany('App\Product','order_items', 'order_id', 'product_id')->withPivot('price', 'original_price', 'quantity');
    }

//    public function sendNotice()
//    {
//        if (!empty($this->seller_id) && !empty($this->user_id) && $this->type == 'order') {
//            switch ($this->status) {
//            case 'open':
//                Notice::create([
//                    'action_type_id' => 1,
//                    'source_id'      => $this->id,
//                    'user_id'        => $this->seller_id,
//                    'sender_id'      => $this->user_id,
//                ]);
//            break;
//            case 'pending':
//                Notice::create([
//                    'action_type_id' => 2,
//                    'source_id'      => $this->id,
//                    'user_id'        => $this->user_id,
//                    'sender_id'      => $this->seller_id,
//                ]);
//            break;
//            case 'closed':
//                Notice::create([
//                    'action_type_id' => 8,
//                    'source_id'      => $this->id,
//                    'user_id'        => $this->seller_id,
//                    'sender_id'      => $this->user_id,
//                ]);
//            break;
//            case 'cancelled':
//                Notice::create([
//                    'action_type_id' => 9,
//                    'source_id'      => $this->id,
//                    'users'          => [$this->seller_id, $this->user_id],
//                ]);
//            break;
//            case 'sent':
//                Notice::create([
//                    'action_type_id' => 11,
//                    'source_id'      => $this->id,
//                    'user_id'        => $this->user_id,
//                    'sender_id'      => $this->seller_id,
//                ]);
//            break;
//        }
//        }
//        // $this->sendMail();
//        return $this;
//    }
//    public function sendMail()
//    {
//        switch ($this->status) {
//            case 'pending':
//                //Sends the user a mail to nitify that the
//                $template = 'emails.order_status_changed';
//                $buyer_user = User::findOrFail($this->user_id);
//                $email = $buyer_user->email;
//                $email_message = trans('email.status_changed.changed_to_pending');
//                $subject = trans('email.status_changed.subject1').$this->id.' '.trans('email.status_changed.subject2').' '.trans('store.pending');
//            break;
//            case 'closed':
//                //Sends the buyer a mail to notify that the Order is Closed
//                $template = 'emails.order_status_changed';
//                $seller_user = User::findOrFail($this->seller_id);
//                $email = $seller_user->email;
//                $email_message = trans('email.status_changed.changed_to_closed');
//                $subject = trans('email.status_changed.subject1').$this->id.' '.trans('email.status_changed.subject2').' '.trans('store.closed');
//            break;
//            case 'sent':
//                //Sends the user a mail to notify that the order is Sent
//                $template = 'emails.order_status_changed';
//                $buyer_user = User::findOrFail($this->user_id);
//                $email = $buyer_user->email;
//                $email_message = trans('email.status_changed.changed_to_sent');
//                $subject = trans('email.status_changed.subject1').$this->id.' '.trans('email.status_changed.subject2').' '.trans('store.sent');
//            break;
//        }
//        $data = [
//            'order_id'      => $this->id,
//            'email'         => $email,
//            'email_message' => $email_message,
//            'new_status'    => $this->status,
//            'subject'       => $subject,
//        ];
//        if (isset($template)) {
//            Mail::queue($template, $data, function ($message) use ($data) {
//                $message->to($data['email'])->subject($data['subject']);
//            });
//        }
//    }

}
