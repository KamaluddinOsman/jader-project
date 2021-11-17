<?php

namespace App\Http\Controllers\Dashboard;

use App\City;
use App\District;
use App\RequestLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CityDistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(City $city)
    {
        $districts=$city->districts()->paginate(20);
        return view('dashboard.pages.district.index')->with(compact('districts','city'));
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
        RequestLog::create(['content' => $request->all(), 'service' => 'create District']);

        $rules = [
            'name'=> 'required' ,
        ];

        $message = [
            'name.required'=> 'يجب ادخال اسم الحى' ,
        ];

        $this->validate($request,$rules,$message);

        $records = new District();
        $records->city_id = $request->id_city;
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
        //
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
        RequestLog::create(['content' => $request->all(), 'service' => 'update District']);

        $district = District::findOrFail($request->district_id);
        $district->update($request->all());
        flash()->success(__('lang.doneEdit'));
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
        RequestLog::create(['content' => $id, 'service' => 'delete District']);

        $records = District::findOrFail($id);
        $records->delete();
        flash()->success(__('lang.doneDelete'));
        return redirect('/city');
    }

}
