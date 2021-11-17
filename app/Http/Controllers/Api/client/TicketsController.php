<?php

namespace App\Http\Controllers\Api\client;

use App\Http\Controllers\Controller;
use App\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return
     */
    public function index()
    {
        $tickets = Ticket::where('user_id', Auth::id())->get();
        $count = count($tickets);
        if ($count <= 0) {
            return ResponseJson('0', 'لا يوجد اى  تذاكر دعم ');
        } else {
            return ResponseJson('200', 'كل تذاكر الدعم الخاصة بك', $tickets);
        }
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
            'title' => 'required',
            'message' => 'required',
            'image'=> 'mimes:jpeg,jpg,png',
        ]);

        if ($validator->fails()) {
            return ResponseJson('0', $validator->errors()->first(),  null);
        }

        $ticket = new Ticket();
        $ticket->user_id = Auth::id();
        $ticket->number  = strtoupper(str_random(10));
        $ticket->title   = $request->title;
        $ticket->message = $request->message;
        $ticket->type    = $request->type;
        $ticket->status  = '0';

        if($file = $request->file( 'image')) {
            $ticket->image = uploadImage($file,'ticket');
        }
        $ticket->save();
        return ResponseJson('200', 'تم التسجيل بنجاح', $ticket);

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @return Response
     */
    public function update(Request $request,$id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(Request $request,$id)
    {

    }
}

?>
