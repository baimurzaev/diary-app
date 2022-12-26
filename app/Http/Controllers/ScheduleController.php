<?php

namespace App\Http\Controllers;

use App\Domain\Schedules\Constants;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ScheduleController extends Controller
{
    public function list(): View
    {
        return view('schedule.list');
    }

    /**
     * @param Request $request
     * @return View
     */
    public function add(Request $request): View
    {
        if ($request->isMethod('post')) {

        }

        // todo вынести из контроллера
        $classrooms = DB::table('classrooms')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('schedule.add', [
            'classrooms' => $classrooms,
            'subjects' => Subject::all(),
            'weeks' => Constants::WEEKS
        ]);
    }
}
