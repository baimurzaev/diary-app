<?php

namespace App\Http\Controllers;

use App\Domain\Schedules\Constants;
use App\Services\Generate\ClassroomService;
use App\Services\Schedules\SchedulesService;
use App\Services\Subjects\SubjectsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ScheduleController extends Controller
{
    public function list(): View
    {
        return view('schedule.list');
    }

    /**
     * @return View
     */
    public function pupil(): View
    {
        return view(
            "schedule.pupil",
            (new SchedulesService())->getScheduleData()
        );
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function double(Request $request): JsonResponse
    {
        $service = new SchedulesService();
        $service->createDouble($request->toArray());

        return response()->json(['status' => 'ok']);
    }

    /**
     * @param Request $request
     * @return View
     */
    public function show(Request $request)
    {
        $id = (int)$request->route('id');

        if ($id <= 0) {
            abort(404);
        }

        $service = new SchedulesService();
        $schedule = $service->getScheduleTmpl($id);

        return view('schedule.show', [
            'schedule' => $schedule,
            'classroom' => (new ClassroomService())->getClassroom($schedule->classroom_id)
        ]);
    }

    /**
     * @param Request $request
     * @return View
     */
    public function add(Request $request): View
    {
        return view('schedule.add', [
            'classrooms' => (new ClassroomService())->getAll(),
            'subjects' => (new SubjectsService())->getAll(),
            'weeks' => Constants::WEEK_DAYS
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        if ($request->isMethod('post')) {
            $service = new SchedulesService();
            if ($service->createSchedule($request->toArray())) {
                return response()->json(['status' => 'ok']);
            }
        }

        return response()->json(['status' => 'err']);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function save(Request $request): JsonResponse
    {
        if ($request->isMethod('post')) {
            $service = new SchedulesService();
            if ($service->editSchedule($request->toArray())) {
                return response()->json(['status' => 'ok']);
            }
        }

        return response()->json(['status' => 'err']);
    }

    public function delete(Request $request)
    {
        if ($request->isMethod('post')) {
            $service = new SchedulesService();
            if ($service->delete($request->toArray())) {
                return response()->json(['status' => 'ok']);
            }
        }

        return response()->json(['status' => 'err']);
    }

    /**
     * @param Request $request
     * @return View
     */
    public function editForm(Request $request): View
    {
        $id = (int)$request->route('id');

        if ($id <= 0) {
            abort(404);
        }

        $service = new SchedulesService();

        return view("schedule.edit", [
            'classrooms' => (new ClassroomService())->getAll(),
            'subjects' => (new SubjectsService())->getAll(),
            'weeks' => Constants::WEEK_DAYS,
            'schedule' => $service->getScheduleTmpl($id),
            'days' => $service->getScheduleLessons($id)
        ]);
    }

    /**
     * @param Request $request
     * @return View
     */
    public function teacher(Request $request): View
    {
        return view("schedule.list", [
            'classrooms' => (new ClassroomService())->getPupilsCount(),
            'schedules' => (new SchedulesService())->getAll()
        ]);
    }
}
