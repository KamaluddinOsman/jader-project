<?php

namespace App\Http\Controllers\Api\client;
use App\Http\Controllers\Controller;
use App\Nationality;
use Illuminate\Http\Request;

class NationalityController extends Controller
{
    public function index()
    {
        $nationality = Nationality::all();
        $count = count($nationality);
        if ($count <= 0) {
            return ResponseJson('0', 'لا يوجد اى جنسيات ');
        } else {
            return ResponseJson('200', 'كل الجنسيات', $nationality, $count);
        }
    }
}
