<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Order;
use App\Store;

class DashboardController extends Controller
{
    public function index(){
        $all_orders = Order::all()->count();
        $canceled_orders = Order::where('status' , 'cancel')->count();
        $padding_orders = Order::where('status' , 'padding')->count();
        $active_orders = Order::where('status' , 'active')->count();

        $all_institutions = Store::all()->count();
        $open_institutions = Store::where('status' , 'open')->count();
        $closed_institutions =Store::where('status' , 'close')->count();
        $pendding_institutions =Store::where('active' , 0)->count();

        return view('dashboard.index', compact(
            'active_orders','padding_orders','canceled_orders' ,'all_orders',
            'all_institutions', 'open_institutions', 'closed_institutions', 'pendding_institutions'
        ));
    }

    public function MarkAllSeen(){
        if (!empty(auth()->unreadnotifications)) {
            foreach (auth()->unreadnotifications as $note) {
                $note->markAsRead;
            }
        }
    }
}
