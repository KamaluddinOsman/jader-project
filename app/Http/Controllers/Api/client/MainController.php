<?php

namespace App\Http\Controllers\Api\client;
use App\Banner;
use App\Brand;
use App\Http\Resources\District as DistrictResource;
use App\Http\Resources\UnitColor as UnitColorResource;
use App\Http\Resources\About as AboutResource;
use App\Http\Resources\Brand as BrandResource;

use App\Category;
use App\City;
use App\Client;
use App\District;
use App\Offer;
use App\Setting;
use App\UnitColor;
use App\Variety;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class MainController extends Controller
{
    public function categories(Request $request){

        if ($request->page){
            $categories = Category::with('childs')->where('activated', 1)->paginate();
        }else{
            $categories = Category::with('childs')->where('activated', 1)->get();
        }

        if ($categories){
            return ResponseJson('200','كل الفئات',$categories);
        }else{
            return ResponseJson('0','كل الفئات');
        }
    }

    public function categoriesChild(Request $request) {
        $categories = Category::where('activated', 1)->where('parent_id', $request->id)->get();
        if ($categories){
            return ResponseJson('200','كل الفئات',$categories);
        }else{
            return ResponseJson('0','كل الفئات');
        }
    }


    public function city(){

        $city = City::get();

        if ($city){
            return ResponseJson('200','كل المدن',$city);
        }else{
            return ResponseJson('0','لا توجد اى  مدينة ');
        }
    }

    public function district(Request $request){
        if($request->city_id){
            $district = DistrictResource::collection(District::where('city_id',$request->city_id)->get());
        }else{
            $district = DistrictResource::collection(District::all());
        }
        $count = count($district);
        if ($count  <= 0){
            return ResponseJson('0','لا يوجد اى  حى ');
        }else{
            return ResponseJson('200','كل الأحياء',$district, $count);

        }
    }

    public function brand(Request $request){

        $brand = BrandResource::collection(Brand::where('category_id',$request->category_id)->get());
        $count = count(Brand::all());
        if ($count  <= 0){
            return ResponseJson('0','لا يوجد اى  براند ');
        }else{
            return ResponseJson('200','كل البراندات',$brand, $count);

        }
    }


    public function unit(Request $request){
        $validator = validator()->make($request->all(),[
            'type' => 'required|in:0,1',
        ]);
        if ($validator->fails())
        {
            return ResponseJson('0',$validator->errors()->first());
        }
        if ($request->type == 1){$type = 'unit';}else{$type = 'color';}

        if ($request->category_id){
            $unit = UnitColorResource::collection(UnitColor::where('type',$type)->where('category_id',$request->category_id)->get());
        }else{
            $unit = UnitColorResource::collection(UnitColor::where('type',$type)->get());
        }

        $count = count($unit);

        if ($count <= 0){
            return ResponseJson('0','لا يوجد مقاسات ');
        }else{
            return ResponseJson('200','بيانات المقاسات',$unit);
        }
    }

    public function about(Request $request){

        $about = AboutResource::collection(Setting::all());

        $count = count($about);

        if ($count <= 0){
            return ResponseJson('0','لا يوجد بيانات ');
        }else{
            return ResponseJson('200','بيانات التطبيق',$about);
        }
    }


    //------------------------------الاشعارات--------------------------------------//

    public function notifications (Request $request){
        $data =  $request->user()->notifications()->get();
        $count = count($data);

        if ($count  <= 0){
            return ResponseJson('0','لا يوجد اشعارات ');
        }else{
            return ResponseJson('200','الإشعارات',$data);

        }
    }

    //------------------------------اشعار--------------------------------------//

    public function notification(Request $request){

        $data =  $request->user()->notifications()->where(['notifications.id' => $request->id])->first();

        if ($data){
            return ResponseJson('200','الإشعارات',$data);
        }else{
            return ResponseJson('0','لا يوجد اشعارات ');
        }
    }

    //------------------------------عدد الاشعارات--------------------------------------//

    public function notificationCount(Request $request){
        $count = $request->user()->notifications()->count();

        return ResponseJson('200', 'عدد الاشعارات', [], $count);
    }


    //--------------------------------------- السليدر ----------------------------------//

    public function banner() {
        $data = Banner::where('active', 1)->get();
        if ($data) {
            return ResponseJson('200','banner',$data);
        }else{
            return ResponseJson('0','لا يوجد بنر ');
        }
    }
}
