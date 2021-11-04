<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index(Setting $records)
  {
      if ($records->all()->count() > 0) {
          $records = Setting::find(1);
      }
      return view('admin.setting.index', compact('records'));

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
  public function update(Request $request)
  {
      if (Setting::all()->count() > 0) {


          $setting = Setting::findOrFail(1);
          $setting->name = $request->input('name');
          $setting->About = $request->input('About');
          $setting->commission = $request->input('commission');
          $setting->phone = $request->input('phone');
          $setting->site = $request->input('site');
          $setting->facebook = $request->input('facebook');
          $setting->FIREBASE_API_KEY = $request->input('FIREBASE_API_KEY');
          $setting->JWT_SECRET = $request->input('JWT_SECRET');
          $setting->GOOGLE_API = $request->input('GOOGLE_API');
          $setting->FACEBOOK_APP_ID = $request->input('FACEBOOK_APP_ID');
          $setting->sms_USERNAME = $request->input('sms_USERNAME');
          $setting->sms_PASSWORD = $request->input('sms_PASSWORD');
          $setting->sms_SENDER = $request->input('sms_SENDER');
          $setting->sms_URL = $request->input('sms_URL');
          $setting->value_added_tax = $request->input('value_added_tax');

          $setting->normal_ratio = $request->input('normal_ratio'); //1
          $setting->zero_ratio = $request->input('zero_ratio'); //2
          $setting->platinum_ratio = $request->input('platinum_ratio'); //3
          $setting->silver_ratio = $request->input('silver_ratio'); //4
          $setting->golden_ratio = $request->input('golden_ratio'); //5
          $setting->massey_ratio = $request->input('massey_ratio'); //6


          if($file = $request->file( 'logo')) {
              $setting->logo = uploadImage($file,'setting');
          }
          $setting->save();

      } else {
          Setting::create($request->all());
      }
      flash()->success('تم الحفظ بنجاح');
      return back();
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {

  }

}

?>
