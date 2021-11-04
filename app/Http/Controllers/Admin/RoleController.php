<?php

namespace App\Http\Controllers\Admin;

use App\RequestLog;
use Illuminate\Http\Request;
use App\Role;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Role::paginate(20);
        return view('admin.role.index')->with(compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        RequestLog::create(['content' => $request->except('_token'), 'service' => 'create Role']);

        $rules = [
            'name'=> 'required|unique:roles,name' ,
            'display_name'=> 'required',
            'permissions_list'=> 'required|array' ,
        ];

        $message = [
            'name.required'=> 'يجب ادخال اسم الرتبة' ,
            'name.unique'=> 'هذا الاسم مستخدم من قبل' ,
            'display_name.required'=> 'هذا الاسم المعروض يجب ادخاله' ,
            'permissions_list.required'=> 'يجب ادخال الصلاحية' ,
        ];

        $this->validate($request,$rules,$message);
        $records = Role::create($request->all());
        $records->permissions()->attach($request->permissions_list);
        flash()->success('تم الحفظ بنجاح');
        return redirect('/role');
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
        $records = Role::findOrFail($id);
        return view('admin.role.edit')->with(compact('records'));
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
        RequestLog::create(['content' => $request->except('_token', 'display_name'), 'service' => 'Update Role']);

        $rules = [
            'name'=> 'required|unique:roles,name,'.$id ,
            'display_name'=> 'required',
            'permissions_list'=> 'required|array' ,
        ];

        $message = [
            'name.required'=> 'يجب ادخال اسم الرتبة' ,
            'name.unique'=> 'هذا الاسم مستخدم من قبل' ,
            'display_name.required'=> 'هذا الاسم المعروض يجب ادخاله' ,
            'permissions_list.required'=> 'يجب ادخال الصلاحية' ,
        ];

        $this->validate($request,$rules,$message);

        $records = Role::findOrFail($id);
        $records->update($request->all());
        $records->permissions()->sync($request->permissions_list);

        flash()->success('تم التعديل بنجاح');
        return redirect('/role');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete($id)
    {
        RequestLog::create(['content' => $id, 'service' => 'Update Role']);

        $records = Role::findOrFail($id);
        $records->delete();
        flash()->success('تم الحذف بنجاح');
        return redirect('/role');

    }
}
