<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\RequestLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
    public function index()
    {
        $records = Brand::get();
        return view('admin.brand.index')->with(compact('records'));
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
        RequestLog::create(['content' => $request->except('_token'), 'service' => 'store brand']);

        $rules = [
            'name'=> 'required' ,
        ];

        $message = [
            'name.required'=> 'يجب ادخال اسم البراند' ,
        ];

        $this->validate($request,$rules,$message);


        $records = new Brand();
        $records->name = $request->input('name');
        $records->category_id = $request->input('category_id');

        $records->save();
        flash()->success(__('lang.doneSave'));
        return redirect('/brand');
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
        RequestLog::create(['content' => $request->except('_token'), 'service' => 'update brand']);

        $rules = [
            'name'=> 'required' ,
        ];
        $message = [
            'name.required'=> 'يجب ادخال اسم البراند' ,
        ];

        $this->validate($request,$rules,$message);

        $records = Brand::findOrFail($request->brand_id);
        $records->name = $request->name;
        $records->category_id = $request->category_id;
        $records->save();
        flash()->success(__('lang.doneSave'));
        return redirect('/brand');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        RequestLog::create(['content' => $id, 'service' => 'delete brand']);

        $records = Brand::findOrFail($id);
        $records->delete();
        flash()->success(__('lang.doneDelete'));
        return redirect('/brand');
    }
}
