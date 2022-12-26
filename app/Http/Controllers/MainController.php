<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        $action = (Auth::user()['group_id'] == 1) ? "teacher" : "pupil";

        return redirect()->action([ScheduleController::class, $action]);
    }
}
