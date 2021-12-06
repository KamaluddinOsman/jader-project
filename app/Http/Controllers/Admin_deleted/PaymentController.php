<?php

namespace App\Http\Controllers\Admin;

use App\Cart;
use App\DriversRequests;
use App\Http\Controllers\Controller;
use App\District;
use App\Product;
use App\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class PaymentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $client = Auth::user();
        $carts = Cart::where('client_id',$client->id)->get();

        if ($carts->count() == 0){
            return ResponseJson('0', 'لاتوجد منتجات فى السلة', null);
        }

        $driverRequest = DriversRequests::where('client_id', $client->id)->first();

        $sumTotal = $carts->sum("total_price") + $driverRequest->price;

        return view('admin.payment.payment',compact('sumTotal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request,$id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {

    }

}

?>
