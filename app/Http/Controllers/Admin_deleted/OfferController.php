<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Offer;
use App\RequestLog;
use Illuminate\Http\Request;

class OfferController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
      $records = Offer::with('product')->orderBy('id', 'desc')->get();
      return view('admin.offer.index')->with(compact('records'));
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
  public function update($id)
  {

  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
      RequestLog::create(['content' => $id, 'service' => 'delete offer']);

      $records = Offer::findOrFail($id);
      $records->delete();
      flash()->success(__('lang.doneDelete'));
      return redirect('/offer');
  }


    public function active($id)
    {
        RequestLog::create(['content' => $id, 'service' => 'active offer']);

        $offer = Offer::findOrFail($id);
        if ($offer->status == 1) {
            $offer->status = 0;
        } else {
            $offer->status = 1;
        }
        $offer->save();
        flash()->success(__('lang.doneActive'));
        return back();
    }
}

?>
