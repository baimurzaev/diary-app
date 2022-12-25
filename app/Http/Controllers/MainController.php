<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function indexPage()
    {
        $startPage = (Auth::user()['group_id'] == 1) ? 'teacher' : 'pupil';

        return view('main.' . $startPage);
    }
}
