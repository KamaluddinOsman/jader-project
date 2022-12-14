<?php

namespace App\Http\Controllers\Admin;

use App\Cart;
use App\Client;
use App\District;
use App\Order;
use App\OrderItem;
use App\RequestLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Image;
use File;


class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Client::get();
        return view('admin.client.index')->with(compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $district = District::all()->sortBy('name',SORT_NATURAL | SORT_FLAG_CASE)->pluck('name','id');
        return view('admin.client.create',compact('district'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        RequestLog::create(['content' => $request->except('_token', 'password'), 'service' => 'create Client']);

        $rules = [
            'first_name'=> 'required|string|min:4' ,
            'last_name'=> 'required|string|min:5' ,
            'phone'=> 'required' ,
            'email'=> 'required|email' ,
            'image' => 'image|mimes:jpeg,jpg,png,gif'
        ];

        $this->validate($request,$rules);
        $client = new Client();
        $client->first_name = $request->input('first_name');
        $client->last_name = $request->input('last_name');
        $client->full_name = $request->input('full_name');
        $client->phone = $request->input('phone');
        $client->email = $request->input('email');
        $client->district_id = $request->input('district_id');
        $client->password = bcrypt($request->input('password'));

        //Upload Image
        if ($request->hasFile('image')) {
            $image_tmp = Input::file('image');
            if ($image_tmp->isValid()) {
                $filename = time() . '.' . $image_tmp->getClientOriginalExtension();
                $path = public_path('storage/images/client/' . $filename);
                $global = config('constants.image_Url');
                $url = $global . 'client/' . $filename;
                Image::make($image_tmp->getRealPath())->resize(468, 249)->save($path);
                $client->image = $url;
            }
        }

        $client->save();
        flash()->success(__('lang.doneSave'));
        return redirect('client');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::findOrFail($id);
        $carts = Cart::with('product')->where('client_id', $id)->get();
        $orders = Order::with('products')->where('client_id', $id)->get();
        return view('admin.client.show',compact('client', 'carts', 'orders'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $records = Client::findOrFail($id);
        return view('admin.client.edit')->with(compact('records'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        RequestLog::create(['content' => $request->except('_token', 'password'), 'service' => 'update Client']);

        $rules = [
            'first_name'=> 'required|string|min:4' ,
            'last_name'=> 'required|string|min:5' ,
            'phone'=> 'required' ,
            'email'=> 'required|email' ,
        ];
        $this->validate($request, $rules);

        $client = Client::findOrFail($id);
        $client->first_name = $request->input('first_name');
        $client->last_name = $request->input('last_name');
        $client->full_name = $request->input('full_name');
        $client->phone = $request->input('phone');
        $client->email = $request->input('email');
        $client->district_id = $request->input('district_id');

        //Upload Image
        if ($request->hasFile('image')) {
            File::delete('storage/images/client/'.$client->image);
            $image_tmp = Input::file('image');
            if ($image_tmp->isValid()) {
                $filename = time() . '.' . $image_tmp->getClientOriginalExtension();
                $path = public_path('storage/images/client/' . $filename);
                $global = config('constants.image_Url');
                $url = $global . 'client/' . $filename;
                Image::make($image_tmp->getRealPath())->resize(468, 249)->save($path);
                $client->image = $url;
            }
        }

        $client->save();
        flash()->success(__('lang.doneSave'));

        return redirect('client');
    }



    public function active($id){

        $client = Client::findOrFail($id);

        if($client->activated == 1){
            $client->activated = 0;
        } else {
            $client->activated = 1;
        }
        $client->save();
        flash()->success(__('lang.doneActive'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        RequestLog::create(['content' => $id, 'service' => 'update Client']);

        $records = Client::findOrFail($id);
        $records->delete();
        flash()->success(__('lang.doneDelete'));
        return redirect('/client');
    }

    public function showdetailsorder(Request $request) {
        $ordershow = Order::where('id', $request->order_id)->first();
        $order_items = OrderItem::where('order_id', $request->order_id)->get();
        $output = view('admin.client.order', ['order' => $ordershow, 'order_items' => $order_items])->render();
        return response()->json([
            'output' => $output
        ]);
    }
}
