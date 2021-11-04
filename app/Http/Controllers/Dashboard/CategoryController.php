<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\RequestLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Image;
use File;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $records = Category::where('parent_id', null)->get();
        return view('dashboard.pages.category.index')->with(compact('records'));
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
        RequestLog::create(['content' => $request->except('_token'), 'service' => 'create category']);

        $rules = [
            'name'   => 'required' ,
            'image'  => 'required|mimes:jpeg,jpg,png',
            'parent_id'  => 'required',

        ];

        $this->validate($request,$rules);


        $records = new Category();
        $records->name = $request->input('name');
        $records->parent_id = $request->input('parent_id');

        //Upload Image
        // if($file = $request->file( 'image')) {
        //     $records->image = uploadImage($file,'category');
        // }

        if($file = $request->file('image')){
            $fileName = time().$file->getClientOriginalName();
            if($file->move('img/category/',$fileName)){
                // $photo   = Photo::create(['image' => $fileName]);
                $records['image'] = 'img/category/'. $fileName;
            }
        }

        $records->save();
        flash()->success(__('lang.doneSave'));
        return redirect('category');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $records = Category::with('parent')->where('parent_id', $id)->get();
        return view('admin.category.show')->with(compact('records'));

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
        RequestLog::create(['content' => $request->except('_token'), 'service' => 'update category']);

        $rules = [
            // 'name'=> 'required' ,
        ];
        $message = [
            'name.required'=> 'يجب ادخال اسم الفئة' ,
        ];

        $this->validate($request,$rules,$message);

        $records = Category::findOrFail($request->category_id);
        if($file = $request->file('image')){
            // return $records;
            if ($records->image == null){
                unlink(public_path().'/'.$records->image);
            }
            $fileName = time().$file->getClientOriginalName();
            if($file->move('img/category/',$fileName)){
                // $photo   = Photo::create(['image' => $fileName]);
                $records['image'] = 'img/category/'. $fileName;
            }
        }

        $records->save();
        flash()->success(__('lang.doneSave'));
        return redirect('/category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        RequestLog::create(['content' => $id, 'service' => 'delete category']);

        $records = Category::findOrFail($id);
        $records->delete();
        flash()->success(__('lang.doneDelete'));
        return redirect('/category');
    }

    public function active($id){
        RequestLog::create(['content' => $id, 'service' => 'active category']);

        $records = Category::findOrFail($id);

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
