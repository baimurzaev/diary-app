<?php

namespace App\Http\Controllers;

use App\Domain\Schedules\Constants;
use App\Models\Subject;
use App\Services\Schedules\SchedulesService;
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
            $service = new SchedulesService($request->toArray());
            $service->createSchedule();
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

    public function teacher(Request $request)
    {
        return view("schedule.teacher");
    }
}
