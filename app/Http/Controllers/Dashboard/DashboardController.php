<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class DashboardController extends Controller
{
    public function index(){
        return view('dashboard.index');
    }

    public function MarkAllSeen(){
        if (!empty(auth()->unreadnotifications)) {
            foreach (auth()->unreadnotifications as $note) {
                $note->markAsRead;
            }
        }
    }
}
