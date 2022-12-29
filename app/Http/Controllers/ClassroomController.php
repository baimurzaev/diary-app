<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Services\Classroom\ClassroomService;
use App\Services\Pupils\PupilsService;
use App\Services\Schedules\SchedulesService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class ClassroomController extends Controller
{
    public function list(): View
    {
        return view('classroom.list', [
            'classrooms' => (new ClassroomService())->getAll()
        ]);
    }

    /**
     * @param Request $request
     * @return Redirector|View
     */
    public function add(Request $request)
    {
        if ($request->isMethod('post')) {
            $service = new ClassroomService();
            $id = $service->createClassroom($request->toArray());

            return redirect('/classroom/edit/id/' . $id);
        }

        return view('classroom.add');
    }

    public function edit(Request $request)
    {
        if ($request->isMethod('post')) {
            $service = new ClassroomService();
            $service->save($request->toArray());
        }

        return back();
    }

    /**
     * @param Request $request
     * @return View
     */
    public function editForm(Request $request): View
    {
        $id = (int)$request->id;

        if ($id > 0 && $classroom = Classroom::find($id)) {
            return view('classroom.edit', [
                'classroom' => $classroom
            ]);
        }

        abort(404);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function delete(Request $request): JsonResponse
    {
        if ($request->isMethod('post')) {
            $id = (int)$request->post('id');

            if ($id > 0 && $classroom = Classroom::find($id)) {
                $classroom->delete();
                return response()->json(['status' => 'ok']);
            }
        }

        return response()->json(['status' => 'err']);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function unlinkPupil(Request $request): JsonResponse
    {
        $service = new PupilsService();
        $result = $service->unlink($request->toArray());

        if ($result > 0) {
            return response()->json(['status' => 'ok']);
        }

        return response()->json(['status' => 'err']);
    }

    public function linkPupil(Request $request): JsonResponse
    {
        $service = new PupilsService();
        $result = $service->link($request->toArray());

        if ($result) {
            return response()->json(['status' => 'ok']);
        }

        return response()->json(['status' => 'err']);
    }

}
