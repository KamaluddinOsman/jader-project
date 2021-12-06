<?php

namespace App\Http\Controllers\Admin;

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
    public function user()
    {
        $tickets = Ticket::where('type', 1)->orderBy('id', 'desc')->get();

        return view('admin.support.index')->with(compact('tickets'));
    }

    public function store()
    {
        $tickets = Ticket::where('type', 2)->orderBy('id', 'desc')->get();

        return view('admin.support.index')->with(compact('tickets'));
    }

    public function car()
    {
        $tickets = Ticket::where('type', 3)->orderBy('id', 'desc')->get();

        return view('admin.support.index')->with(compact('tickets'));
    }


    public function update(Request $request, $id)
    {
        $tickets = Ticket::where('id', $id)->update([
            'status' => $request->status
        ]);
    }
}

?>
