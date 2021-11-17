<?php

namespace App\Http\Controllers\Vendors;

use App\Http\Requests\CategoryRequest;
use App\Models\Product;
use App\SpacialCategory;
use App\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SpacialCategoryController extends Controller
{
    public function index(){

        $user = auth()->user();
        $store = Store::where('client_id', $user->id)->pluck('active')->first();
        $category = SpacialCategory::where("store_id",   $store)->paginate(PAGINATION_COUNT_VENDOR);
        return view('vendors.category.index', compact('category'));
    }

    public function create()
    {
        return view('vendors.category.create');
    }


    public function store(Request $request)
    {

        try{
            $user = auth()->user();
        $store = Store::where('client_id', $user->id)->pluck('active')->first();
        $rules = [
            'name'=> 'required' ,
        ];

        $message = [
            'name.required'=> 'يجب ادخال الاسم ' ,
        ];

        $this->validate($request,$rules,$message);


        $records = new SpacialCategory();
        $records->name = $request->input('name');
        $records->store_id = $store;
        $records->save();
        return redirect()->route('vendors.categories')->with(['success' => 'تم الحفظ بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('vendors.categories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }




    public function destroy($id)
    {

        try {
            //get specific categories and its translations
            $contaier = SpacialCategory::orderBy('id', 'DESC')->find($id);

            if (!$contaier)
                return redirect()->route('vendors.categories')->with(['error' => 'هذا القسم غير موجود ']);
            $contaier->delete();
            return redirect()->route('vendors.categories')->with(['success' => 'تم  الحذف بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('vendors.categories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }




    public function edit($mainCat_id)
    {
        //get specific categories and its translations
        $mainCategory = SpacialCategory::find($mainCat_id);

        if (!$mainCategory)
            return redirect()->route('vendors.categories')->with(['error' => 'هذا القسم غير موجود ']);

        return view('vendors.category.edit', compact('mainCategory'));
    }



    public function update(Request $request,$id)
    {

        try {
//        RequestLog::create(['content' => $request->except('_token'), 'service' => 'Update Color']);
        $store = Store::where('client_id', 1)->pluck('active')->first();
        $rules = [
            'name'=> 'required' ,
        ];

        $message = [
            'name.required'=> 'يجب ادخال اسم اللون' ,
        ];

        $this->validate($request,$rules,$message);

        $records = SpacialCategory::find($id);
        $records->name = $request->name;
        $records->store_id = $store;
        $records->save();
        return redirect()->route('vendors.categories')->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $exception) {
            return $exception;
            DB::rollback();
            return redirect()->route('vendors.categories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }







}
