<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function add(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->only(['username', 'password']);
        }

        return view('schedule.add');
    }
}
