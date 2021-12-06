<?php

namespace App\Http\Controllers\Admin;

use App\RequestLog;
use App\UnitColor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;



class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $records = UnitColor::where('type','color')->get();
        return view('admin.color.index')->with(compact('records'));
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
        RequestLog::create(['content' => $request->except('_token'), 'service' => 'Create Color']);

        $rules = [
            'name'=> 'required' ,
            'code'=> 'required' ,
        ];

        $message = [
            'name.required'=> 'يجب ادخال اسم اللون' ,
            'code.required'=> 'يجب ادخال كود اللون' ,
        ];

        $this->validate($request,$rules,$message);


        $records = new UnitColor();
        $records->name = $request->input('name');
        $records->category_id = $request->input('category_id');
        $records->code = $request->input('code');
        $records->type = 'color';

        $records->save();
        flash()->success(__('lang.doneSave'));
        return redirect('/color');
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
        RequestLog::create(['content' => $request->except('_token'), 'service' => 'Update Color']);

        $rules = [
            'name'=> 'required' ,
            'code'=> 'required' ,
        ];

        $message = [
            'name.required'=> 'يجب ادخال اسم اللون' ,
            'code.required'=> 'يجب ادخال كود اللون' ,
        ];

        $this->validate($request,$rules,$message);

        $records = UnitColor::findOrFail($request->color_id);
        $records->name = $request->name;
        $records->code = $request->code;
        $records->category_id = $request->category_id;
        $records->save();
        flash()->success(__('lang.doneSave'));
        return redirect('/color');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        RequestLog::create(['content' => $id, 'service' => 'Create Color']);

        $records = UnitColor::findOrFail($id);
        $records->delete();
        flash()->success(__('lang.doneDelete'));
        return redirect('/color');
    }
}
