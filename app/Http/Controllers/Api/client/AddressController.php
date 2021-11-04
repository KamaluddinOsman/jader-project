<?php

namespace App\Http\Controllers\Api\client;

use App\Address;
use App\Http\Controllers\Controller;
use App\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $addresses = Auth::user()->addresses->sortByDesc('default');

        return ResponseJson('200', 'كل البيانات', $addresses);

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
        $validator = validator()->make($request->all(), [
            'title' => 'required |unique:addresses' ,
            'lang' => 'required',
            'late' => 'required',
            'default' => 'in:0,1',
        ]);

        if ($validator->fails()) {
            return ResponseJson('0', $validator->errors()->first(),  null);
        }

        $client = Auth::user();
        $default = $client->addresses->count();

        $address = new Address();
        $address->title = $request->title;
        $address->lang = $request->lang;
        $address->late = $request->late;
        $address->city = $request->city;
        $address->state = $request->state;
         $address->descrption = $request->descrption;
        $address->client_id = $client->id ;
        if ($default == 0){ $address->default = 1;}
        $address->save();

        return ResponseJson('200', 'تم الحفظ بنجاح', $address);

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $validator = validator()->make($request->all(), [
            'lang' => 'required',
            'late' => 'required',
        ]);

        if ($validator->fails()) {
            return ResponseJson('0', $validator->errors()->first(),  null);
        }

        $address = Address::find($id);
        $address->title = $request->title;
        $address->lang  = $request->lang;
        $address->late  = $request->late;
        $address->city  = $request->city;
        $address->state = $request->state;
        $address->save();

        return ResponseJson('200', 'تم التعديل بنجاح', $address);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        $address = Address::where('id',$id)->first();
        $address->delete();

        return ResponseJson('200','تم حذف العنوان ');
    }
}
