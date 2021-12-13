<?php

namespace App\Http\Controllers\Dashboard;

use App\RequestLog;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::get();
        return view('dashboard.pages.user.index')->with(compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.pages.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        RequestLog::create(['content' => $request->except('_token'), 'service' => 'Create User']);

        $rules = [
            'name'=> 'required' ,
            'email'=> 'required|email' ,
            'roles_list'=>'required'
        ];

        $message = [
            'name.required'=> 'يجب ادخال الإسم' ,
            'email.required'=> 'يجب ادخال الايميل' ,
            'roles_list.required'=> 'يجب ادخال الصلاحية' ,
        ];

        $this->validate($request,$rules,$message);

        $request->merge(['password' => bcrypt($request->password)]);
        $user = User::create($request->except('roles_list'));
        $user->roles()->attach($request->input('roles_list'));

        flash()->success( __('user.savedSuccessfully') );
        return redirect('/user');
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
        $records = User::findOrFail($id);
        return view('dashboard.pages.user.edit')->with(compact('records'));
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
        RequestLog::create(['content' => $request->except('_token'), 'service' => 'Update User']);

        $rules = [
            'name'=> 'required' ,
            'email'=> 'required|email' ,
            'roles_list'=>'required'
        ];

        $message = [
            'name.required'=> 'يجب ادخال الإسم' ,
            'email.required'=> 'يجب ادخال الايميل' ,
            'roles_list.required'=> 'يجب ادخال الصلاحية' ,
        ];
        $this->validate($request,$rules,$message);

        $user = User::findOrFail($id);
        if (Auth::id() == '1'){
           $request->merge(['password' => bcrypt($request->password)]);
        }

        $user->roles()->sync((array) $request->input('roles_list'));
        $update = $user->update($request->all());

        flash()->success( __('user.editedSuccessfully') );
        return redirect('user');
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
        RequestLog::create(['content' => $id, 'service' => 'Delete User']);

        $records = User::findOrFail($id);
        $records->delete();
        flash()->success( __('user.deletedSuccessfully') );
        return redirect('/user');

    }



    public function editPassword()
    {
        return view('dashboard.pages.user.editPassword');
    }


    public function updatePassword(Request $request){

        $rules = [
            'old_password'=> 'required' ,
            'password'=> 'required|confirmed' ,
        ];

        $message = [
            'old_password.required'=> 'يجب ادخال كلمة السر القديمة' ,
            'password.required'=> 'يجب ادخال كلمة السر الجديدة' ,
            'password.confirmed'=> 'ليست متطابقة' ,
        ];

        $this->validate($request,$rules,$message);

        $data = $request->all();
        $user = User::where('id',Auth::User()->id)->first();

        $old_password = $data['old_password'];

        if (Hash::check($old_password,$user->password)){
            $user = bcrypt($data['password']);
            User::where('id',Auth::User()->id)->update(['password'=>$user]);

            flash()->success( __('user.passwordChangedSuccessfully') );

            return back();

        }else{
            flash()->error( __('user.passwordCheck') );
            return back();
        }

    }
}
