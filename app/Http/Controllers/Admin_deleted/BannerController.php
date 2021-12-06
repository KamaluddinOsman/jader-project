<?php

namespace App\Http\Controllers\Admin;

use App\Banner;
use App\RequestLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Image;
use File;


class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $records = Banner::get();
        return view('admin.banner.index')->with(compact('records'));
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
        RequestLog::create(['content' => $request->except('_token'), 'service' => 'create Banner']);

        $rules = [
            'title'   => 'required' ,
            'image'  => 'required|mimes:jpeg,jpg,png,gif',
        ];

        $message = [
            'name.required'=> 'يجب ادخال عنوان الصوره ' ,
        ];

        $this->validate($request,$rules,$message);


        $records = new Banner();
        $records->title = $request->input('title');
        $records->description = $request->input('description');
        $records->active = $request->input('active') ? '1' : '0';

        //Upload Image
        if($file = $request->file( 'image')) {
            $records->image = uploadImage($file,'banner');
        }


        $records->save();
        flash()->success(__('lang.doneSave'));
        return redirect('/banner');
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
        RequestLog::create(['content' => $request->except('_token'), 'service' => 'update Banner']);

        $rules = [
            'title'   => 'required' ,
            'image'  => 'mimes:jpeg,jpg,png,gif',
        ];

        $message = [
            'name.required'=> 'يجب ادخال عنوان الصوره ' ,
        ];

        $this->validate($request,$rules,$message);

        $records = Banner::findOrFail($request->banner_id);
        //Upload Image
        if($request->hasFile('image')){
            File::delete('storage/images/Banner/'.$records->image);
            //Upload Image
            if($file = $request->file( 'image')) {
                $records->image = uploadImage($file,'banner');
            }
        }

        $records->title = $request->title;
        $records->description = $request->description ? $request->description : $records->description;
        $records->active = $request->active;
        $records->save();
        flash()->success(__('lang.doneSave'));
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        RequestLog::create(['content' => $id, 'service' => 'delete Banner']);

        $records = Banner::findOrFail($id);

//        $image = Str::after($records->image, 'Banner/');
//        $image = base_path('public\storage\images\banner\\'.$image);
//        unlink($image);

        $records->delete();
        flash()->success(__('lang.doneDelete'));
        return redirect()->back();
    }

    public function active($id){
        RequestLog::create(['content' => $id, 'service' => 'active Banner']);

        $records = Banner::findOrFail($id);

        if($records->active == 1){
            $records->active = 0;
        } else {
            $records->active = 1;
        }
        $records->save();

        flash()->success(__('lang.doneActive'));
        return back();
    }
}
