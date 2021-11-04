<?php

namespace App\Http\Controllers\Api\client;

use App\SpacialCategory;
use App\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SpacialCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::id();
        $store = Store::where('client_id', $user)->first();
        if (!$store){
            return ResponseJson('200', 'لا يوجد منشأه');
        }

        $unActive = SpacialCategory::where('status', 4)->count();
        $SCategory = SpacialCategory::where('store_id', $store->id)->get();
        $data = [
           'unActive'        =>  $unActive,
           'SpacialCategory'  =>  $SCategory,
        ];
        return ResponseJson('200', 'كل الفئات', $data);

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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return ResponseJson('0', $validator->errors()->first(), null);
        }


        $user = Auth::id();
        $store = Store::where('client_id', $user)->first();

        if (!$store){
            return ResponseJson('200', 'لا يوجد منشأه');
        }
        $SCategory = new SpacialCategory();
        $SCategory->name = $request->name;
        $SCategory->store_id = $store->id;
        $SCategory->save();

        return ResponseJson('200', 'تم الحفظ بنجاح', $SCategory);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!$request->status){
            $validator = validator()->make($request->all(), [
                'name' => 'required',
            ]);

            if ($validator->fails()) {
                return ResponseJson('0', $validator->errors()->first(), null);
            }
        }


        $user = Auth::id();
        $store = Store::where('client_id', $user)->first();

        if (!$store){
            return ResponseJson('0', 'لا يوجد منشأه');
        }
        $SCategory = SpacialCategory::find($id);
        if ($request->name){
            $SCategory->name = $request->name;
        }

        if ($request->status){
            $SCategory->status = $request->status;
        }
        $SCategory->store_id = $store->id;
        $SCategory->save();

        return ResponseJson('200', 'تم التعديل بنجاح', $SCategory);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $SCategory = SpacialCategory::where('id', $id)->first();
        if ($SCategory) {
            $SCategory->delete();
            return ResponseJson('200', 'تم حذف الفئة ');
        } else {
            return ResponseJson('200', 'تم حذف سابقا ');
        }
    }
}
