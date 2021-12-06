<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{

    public function coupon()
    {
        $coupons = Coupon::all();
        return view('admin.coupon.coupon', compact('coupons'));
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'coupon' => 'required|max:255'
        ]);

        $data = new Coupon();
        $data->coupon = $request->coupon;
        $data->discount = $request->discount;
        $data->start_date = $request->start_date;
        $data->end_date = $request->end_date;
        $data->count_use = $request->count_use;
        $data->save();

        flash()->success(__('lang.doneSave'));
        return redirect()->back();
    }

    public function edit($id)
    {
        $coupon = Coupon::where('id', $id)->first();
        return view('admin.coupon.edit', compact('coupon'));
    }

    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'coupon' => 'required|max:255'
        ]);


        $data = Coupon::where('id', $id)->first();
        $data->coupon = $request->coupon;
        $data->discount = $request->discount;
        $data->start_date = $request->start_date;
        $data->end_date = $request->end_date;
        $data->count_use = $request->count_use;
        $data->save();

        if ($data) {
            flash()->success(__('lang.doneEdit'));
            return redirect()->route('coupons');
        }
    }

    public function delete($id)
    {
        Coupon::find($id)->delete();
        flash()->success(__('lang.doneDelete'));
        return redirect()->back();
    }

}
