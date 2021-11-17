<?php

namespace App\Http\Controllers\Dashboard;

use App\Car;
use App\Client;
use App\MoneyAccount;
use App\RequestLog;
use App\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ramsey\Uuid\Uuid;

class MoneyAccountController extends Controller
{

    public function index()
    {
        $records = MoneyAccount::where('status', 'remittance')->get();
        return view('dashboard.pages.account.index')->with(compact('records'));
    }


    public function create()
    {
        return view('dashboard.pages.account.create');
    }

    public function store(Request $request)
    {
        RequestLog::create(['content' => $request->except('_token', 'body'), 'service' => 'create money trance']);

        $rules = [
            'client_id' => 'required',
            'money' => 'required|int',
            'image' => 'required|mimes:jpeg,jpg,png',

        ];
        $this->validate($request, $rules);


        if ($request->type == 'car' || $request->type == 'stores'){
            $client = Client::with($request->type)->where('id', $request->client_id)->first();
        }else{
            $client = Client::where('id', $request->client_id)->first();
        }
        $money = new MoneyAccount();

        if ($request->type == 'car') {
            $car_id = $client->car->id;
            $money->car_id = $car_id;
        }

        if ($request->type == 'stores') {
            $store = $client->stores->id;
            $money->store_id = $store;
        }

        if ($request->type == 'client') {
            $money->client_id = $request->client_id;
        }

        $money->user_id = auth()->id();
        $money->client_money = $request->input('money');
        $money->status = 'remittance';
        $money->note = $request->input('note');
        $money->total_money = $request->input('money');
        $money->transfer_Number = $request->input('transfer_Number');

        if($file = $request->file( 'image')) {
            $money->image = uploadImage($file,'transfer');
        }

        $money->save();

        $notification = $client->notifications()->create([
            'id' => Uuid::uuid4(),
            'type' => 'MoneyAccount',
            'title' => 'تحويل مبلغ',
            'body' => 'من تطبيق جدير' . $request->input('money') . 'تم تحويل مبلغ ',
        ]);

        $tokens = $client->tokens()->where('token', '!=', '')->pluck('token')->toArray();
        if (count($tokens)) {
            $title = $notification->title;
            $body = $notification->body;
            $data = [
                'test' => '1'
            ];
            $send = notifyByFirebase($title, $body, $tokens, $data);
        }

        flash()->success(__('lang.doneSave'));
        return redirect()->back();
    }


    public function getclient($type)
    {
        if ($type == 'client') {
            $client = Client::get();
        } else {
            $client = Client::whereHas($type)->get();
        }
        $output = view('dashboard.pages.account.client', ['client' => $client, 'type' => $type])->render();
        return response()->json([
            'output' => $output
        ]);
    }

    public function getAccounts(Request $request, $id)
    {
        $remittance = '';
        $rest = '';
        $site_money = '';
        $total = '';

        if ($request->type == 'client') {
            $commission = MoneyAccount::where('client_id', $id)->where('status', 'bounced_back')->pluck('client_money')->sum();
            $remittance = MoneyAccount::where('client_id', $id)->where('status', 'remittance')->pluck('client_money')->sum();
            $rest = $commission - $remittance ;
            $total =  $rest + $remittance ;

        } elseif ($request->type == 'stores') {

            $client = Client::with('stores')->where('id', $id)->first();
            $store = $client->stores->id;
            $commission = MoneyAccount::where('store_id', $store)->where('status', 'commission')->pluck('client_money')->sum();
            $remittance = MoneyAccount::where('store_id', $store)->where('status', 'remittance')->pluck('client_money')->sum();
            $site_money = MoneyAccount::where('store_id', $store)->where('status', 'commission')->pluck('site_money')->sum();
            $rest = $commission - $remittance ;
            $total = $commission + $rest + $site_money ;

        } else {
            $client = Client::with('car')->where('id', $id)->first();
            $car = $client->car->id;
            $commission = MoneyAccount::where('car_id', $car)->where('status', 'commission')->pluck('client_money')->sum();
            $remittance = MoneyAccount::where('car_id', $car)->where('status', 'remittance')->pluck('client_money')->sum();
            $site_money = MoneyAccount::where('car_id', $car)->where('status', 'commission')->pluck('site_money')->sum();
            $rest = $commission - $remittance ;
            $total = $remittance + $rest + $site_money ;
        }
        $output = view('dashboard.pages.account.accountCommission', ['remittance' => $remittance, 'rest' => $rest, 'site_money' => $site_money, 'total' => $total, 'type' => $request->type])->render();
        return response()->json([
            'output' => $output
        ]);
    }

    public function show($id){
        $car = '';
        $store = '';
        $client = '';
        $rest = '';
        $site_money = '';
        $total = '';
        $commission = '';

        $trans =  MoneyAccount::with('user')->where('id', $id)->first();
        $carbon =  \Carbon\Carbon::parse($trans->created_at)->diffForHumans();
        if ($trans->car_id !== null){
            $car = Car::with('client')->where('id', $trans->car_id)->first();
            $commission = MoneyAccount::where('car_id', $car->id)->where('status', 'commission')->pluck('client_money')->sum();
            $remittance = MoneyAccount::where('car_id', $car->id)->where('status', 'remittance')->pluck('client_money')->sum();
            $site_money = MoneyAccount::where('car_id', $car->id)->where('status', 'commission')->pluck('site_money')->sum();
            $rest = $commission - $remittance ;
            $total = $commission + $rest + $site_money ;
        }elseif ($trans->store_id !== null){
            $store = Store::with('client')->where('id', $trans->store_id)->first();
            $commission = MoneyAccount::where('store_id', $store->id)->where('status', 'commission')->pluck('client_money')->sum();
            $remittance = MoneyAccount::where('store_id', $store->id)->where('status', 'remittance')->pluck('client_money')->sum();
            $site_money = MoneyAccount::where('store_id', $store->id)->where('status', 'commission')->pluck('site_money')->sum();
            $rest = $commission - $remittance ;
            $total = $commission + $rest + $site_money ;

        }else{
            $client = Client::where('id', $trans->client_id)->first();
            $commission = MoneyAccount::where('client_id', $client->id)->where('status', 'bounced_back')->pluck('client_money')->sum();
            $remittance = MoneyAccount::where('client_id', $client->id)->where('status', 'remittance')->pluck('client_money')->sum();
            $rest = $commission - $remittance ;
            $total =  $rest + $remittance ;
        }
        return view('dashboard.pages.account.show', compact('trans', 'carbon', 'car', 'store', 'client', 'rest', 'site_money', 'total', 'commission'));

    }
}

//* -1
