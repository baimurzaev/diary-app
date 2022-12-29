<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Services\Classroom\ClassroomService;
use App\Services\Pupils\PupilsService;
use App\Services\Schedules\SchedulesService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PupilsController extends Controller
{
    /**
     * @param Request $request
     * @return View
     */
    public function list(Request $request): View
    {
        $service = new PupilsService();

        return view('pupils.list', [
            'pupils' => $service->paginate(30)->list()
        ]);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function classroom(Request $request): mixed
    {
        $classroomId = (int)$request->id;
        if ($classroomId > 0 && Classroom::find($classroomId)) {
            $service = new ClassroomService();

            return view('pupils.classroom', [
                'count' => $service->getClassroomUsersCount($classroomId),
                'pupils' => $service->getClassroomPupils($classroomId),
                'schedules' => (new SchedulesService())->getAllForSelect()
            ]);
        }

        return response('');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function search(Request $request): JsonResponse
    {
        $request->toArray();
        $service = new PupilsService();

        return response()->json($service->search($request));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function addSchedule(Request $request): JsonResponse
    {
        $service = new PupilsService();
        $result = $service->addGroup($request->toArray());

        if ($result) {
            return response()->json(['status' => 'ok']);
        }

        return response()->json(['status' => 'err']);
    }
}
