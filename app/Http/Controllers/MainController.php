<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    /**
     * @return Redirector
     */
    public function index(): Redirector
    {
        if (Auth::user()['group_id'] == 2) {
            return redirect("/main/schedules");
        };

        return redirect("/schedules");
    }
}
