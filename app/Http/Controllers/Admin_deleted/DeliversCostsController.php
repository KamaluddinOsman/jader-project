<?php

namespace App\Http\Controllers\Admin;

use App\RequestLog;
use Illuminate\Http\Request;
use App\DeliveryCost;
use App\Http\Controllers\Controller;

class DeliversCostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = DeliveryCost::paginate(20);
        return view('admin.delivers_costs.index')->with(compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.delivers_costs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        RequestLog::create(['content' => $request->except('_token'), 'service' => 'create DeliveryCost']);

        $rules = [
            'from_k'=> 'required|between:0,99.99',
            'to_k'=> 'required|between:0,99.99',
            'from_price'=> 'required|between:0,99.99',
            'to_price'=> 'required|between:0,99.99',
            'type_car'=> 'required',
        ];

        $this->validate($request,$rules);
        $records = DeliveryCost::create($request->all());
        flash()->success('تم الحفظ بنجاح');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $records = DeliveryCost::findOrFail($id);
        return view('admin.delivers_costs.edit')->with(compact('records'));
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
        RequestLog::create(['content' => $request->except('_token', 'display_name'), 'service' => 'Update DeliveryCost']);

        $rules = [
            'from_k'=> 'required|between:0,99.99',
            'to_k'=> 'required|between:0,99.99',
            'from_price'=> 'required|between:0,99.99',
            'to_price'=> 'required|between:0,99.99',
            'type_car'=> 'required',
        ];

        $this->validate($request,$rules);

        $records = DeliveryCost::findOrFail($id);
        $records->update($request->all());

        flash()->success('تم التعديل بنجاح');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function delete($id)
    {
        RequestLog::create(['content' => $id, 'service' => 'Update DeliveryCost']);

        $records = DeliveryCost::findOrFail($id);
        $records->delete();
        flash()->success('تم الحذف بنجاح');
        return redirect()->back();

    }
}
