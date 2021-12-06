<?php

namespace App\Http\Controllers\Admin;

use App\City;
use App\District;
use App\RequestLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = City::all();
        return view('admin.city.index')->with(compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        RequestLog::create(['content' => $request->except('_token'), 'service' => 'create city']);

        $rules = [
            'name'=> 'required' ,
        ];

        $message = [
            'name.required'=> 'يجب ادخال اسم المحافظة' ,
        ];

        $this->validate($request,$rules,$message);


        $records = new City();
        $records->name = $request->input('name');
        $records->save();

        flash()->success(__('lang.doneSave'));

        return redirect('/city');

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
        RequestLog::create(['content' => $request->except('_token'), 'service' => 'update city']);

        $rules = [
            'name'=> 'required' ,
        ];

        $message = [
            'name.required'=> 'يجب ادخال اسم المحافظة' ,
        ];

        $this->validate($request,$rules,$message);

        $city = City::findOrFail($request->city_id);
        $city->update($request->all());
        flash()->success(__('lang.doneEdit'));
        return redirect('/city');
    }

    public function addDistrict(Request $request){


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        RequestLog::create(['content' => $id, 'service' => 'delete city']);

        $records = City::findOrFail($id);
        $records->delete();
        flash()->success(__('lang.doneDelete'));
        return redirect('/city');

    }
}
