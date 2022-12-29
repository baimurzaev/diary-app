<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Services\Subjects\SubjectsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class SubjectsController extends Controller
{
    public function list()
    {
        return view('subjects.list', [
            'subjects' => (new SubjectsService())->getAll()
        ]);
    }

    /**
     * @param Request $request
     * @return Redirector|View
     */
    public function add(Request $request)
    {
        if ($request->isMethod('post')) {
            $service = new SubjectsService();
            $service->createSubject($request->toArray());

            return redirect('/subjects');
        }

        return view('subjects.add');
    }

    /**
     * @param Request $request
     * @return Redirector|View
     */
    public function edit(Request $request)
    {
        $service = new SubjectsService();

        if ($request->isMethod('post')) {
            $service->editSubject($request->toArray());

            return redirect('/subjects');
        }

        if (!$id = $request->route('id')) {
            abort(404);
        }

        return view('subjects.edit', [
            'subject' => $service->byId($id)
        ]);
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
                if ($subject = Subject::find($id)) {
                    $subject->delete();
                    return response()->json(['status' => 'ok']);
                }
            }
        }

        return response()->json(['status' => 'err']);
    }
}
