<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\RequestLog;
use App\Variety;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryVarietyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        $varietys=$category->varieties()->get();
        return view('admin.variety.index')->with(compact('varietys','category'));
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
        RequestLog::create(['content' => $request->except('_token'), 'service' => 'create Variety']);

        $rules = [
            'name'=> 'required' ,
        ];

        $message = [
            'name.required'=> 'يجب ادخال اسم الفئة' ,
        ];

        $this->validate($request,$rules,$message);

        $records = new Variety();
        $records->category_id = $request->id_category;
        $records->name = $request->input('name');
        $records->activated = '1';
        $records->save();

        flash()->success(__('lang.doneSave'));

        return redirect('/category');
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
        RequestLog::create(['content' => $request->except('_token'), 'service' => 'update Variety']);

        $rules = [
            'name'=> 'required' ,
        ];

        $message = [
            'name.required'=> 'يجب ادخال اسم الحى' ,
        ];

        $this->validate($request,$rules,$message);

        $variety = Variety::findOrFail($request->variety_id);
        $variety->name = $request->name;
        $variety->save();
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
        RequestLog::create(['content' => $id, 'service' => 'delete Variety']);

        $records = Variety::findOrFail($id);
        $records->delete();
        flash()->success(__('lang.doneDelete'));
        return redirect('/category');
    }

    public function active($id){
        RequestLog::create(['content' => $id, 'service' => 'active Variety']);

        $records = Variety::findOrFail($id);

        if($records->activated == 1){
            $records->activated = 0;
        } else {
            $records->activated = 1;
        }
        $records->save();
        flash()->success(__('lang.doneActive'));
        return back();
    }

}
