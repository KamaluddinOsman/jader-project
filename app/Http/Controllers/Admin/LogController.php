<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\RequestLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LogController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
    public function index()
    {
        $records = RequestLog::get();
        return view('admin.log.index')->with(compact('records'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {

        $records = RequestLog::findOrFail($id);
        $records->delete();
        flash()->success(__('lang.doneDelete'));
        return redirect('/log');
    }
}
