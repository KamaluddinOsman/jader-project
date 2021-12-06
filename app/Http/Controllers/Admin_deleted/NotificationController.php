<?php

namespace App\Http\Controllers\Admin;

use App\Car;
use App\Client;
use App\RequestLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ramsey\Uuid\Uuid;


class NotificationController extends Controller
{
    public function create(){
        return view('admin.notification.create');
    }

    public function store(Request $request){
        RequestLog::create(['content' => $request->except('_token', 'body'), 'service' => 'create Notifications']);

        $rules = [
            'body'=> 'required|string' ,
            'title' => 'required|string|max:60' ,
        ];
        $this->validate($request, $rules);


        if ($request->type == 'car'){
            $clients = Client::whereHas('car')->get();
        }

        if ($request->type == 'client'){
            $clients = Client::get();
        }

        if ($request->type == 'store'){
            $clients = Client::whereHas('stores')->get();
        }

        foreach ($clients as $client){
            $notification =  $client->notifications()->create([
                'id'       => Uuid::uuid4(),
                'type'     => $request->type,
                'title'    => $request->title,
                'body'     => $request->body ,
            ]);


            $tokens = $client->tokens()->where('token','!=','')->pluck('token')->toArray();
            if (count($tokens)){
                $title = $notification->title;
                $body = $notification->body;
                $data = [
                    'test' => '1'
                ];
                $send = notifyByFirebase($title,$body,$tokens, $data);
            };
        }


        flash()->success(__('lang.doneSave'));
        return redirect()->back();
    }
}
