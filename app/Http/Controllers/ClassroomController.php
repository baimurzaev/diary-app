<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Services\Classroom\ClassroomService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ClassroomController extends Controller
{
    public function list(): View
    {
        $pupils = DB::table('classrooms')->orderBy('created_at','desc')->get();

        return view('classroom.list', [
            'classrooms' =>$pupils
        ]);
    }

    public function pupilsList(Request $request)
    {
        $classroomId = (int)$request->id;

        if ($classroomId > 0) {
            $service = new ClassroomService();
            if (Classroom::find($classroomId)) {
                $count = $service->getClassroomUsersCount($classroomId);
                $pupils = $service->getClassroomPupils($classroomId);

                return view('classroom.pupils', [
                    'count' => $count,
                    'pupils' => $pupils
                ]);
            }
        }

        return '';
    }

    public function add(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->only(['name']);

            if (mb_strlen($input['name']) >= 2) {
                $classroom = new Classroom();
                $classroom->name = $input['name'];
                $classroom->save();

                return redirect('/classroom/edit/id/' . $classroom->id);
            }
        }

        return view('classroom.add');
    }

    /**
     * @param Request $request
     * @return View
     */
    public function edit(Request $request): View
    {
        $id = (int)$request->id;

        if ($id > 0) {
            $classroom = Classroom::find($id);

            if (!$classroom) {
                abort(404);
            }

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

            if ($id > 0) {
                /** @var Classroom $classroom */
                $classroom = Classroom::find($id);

                if ($classroom) {
                    $classroom->delete();
                    return response()->json(['status' => 'ok']);
                }
            }
        }

        return response()->json(['status' => 'err']);
    }

}
