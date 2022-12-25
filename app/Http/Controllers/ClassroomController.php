<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClassroomController extends Controller
{
    public function list(): View
    {
        return view('classroom.list', [
            'classrooms' => Classroom::all()
        ]);
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
     * @return void
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

    public function delete(Request $request)
    {
        if ($request->isMethod('post')) {
            $id = (int)$request->id;
            if ($id > 0) {
                /** @var Classroom $classroom */
                $classroom = Classroom::find($id);
                if ($classroom) {
                    $classroom->delete();

                    response()->json(['status' => 'ok']);
                }
            }
        }

        return response()->json(['status' => 'err']);
    }


}
