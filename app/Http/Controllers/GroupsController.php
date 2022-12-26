<?php

namespace App\Http\Controllers;

use App\Models\GroupPupil;
use App\Services\Pupils\GroupPupilsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

final class GroupsController extends Controller
{
    public function list()
    {
        return view('groups.list', [
            'groups' => GroupPupil::all()
        ]);
    }

    public function add(Request $request)
    {
        if ($request->isMethod('post')) {
            $name = $request->post('name');
            if (mb_strlen($name) >= 2) {
                $group = new GroupPupil();
                $group->name = $name;
                $group->save();

                return redirect('/groups/edit/id/' . $group->id);
            }
        }

        return view('groups.add');
    }

    /**
     * @param Request $request
     * @return View
     */
    public function edit(Request $request): View
    {
        $id = $request->isMethod('post')
            ? $request->post('id') : $request->id;

        if ((int)$id <= 0 || !$group = GroupPupil::find($id)) {
            abort(404);
        }

        if ($request->isMethod('post')) {
            $name = $request->post('name');

            if ($id > 0 && mb_strlen($name) >= 2) {
                $group = GroupPupil::find($id);
                $group->name = $name;
                $group->save();
            }
        }

        return view('groups.edit', [
            'group' => $group
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
                if ($group = GroupPupil::find($id)) {
                    $group->delete();
                    return response()->json(['status' => 'ok']);
                }
            }
        }

        return response()->json(['status' => 'err']);
    }

    public function pupilsList(Request $request): View|string
    {
        $groupId = (int)$request->id;

        if ($groupId > 0) {
            if (GroupPupil::find($groupId)) {
                $service = new GroupPupilsService();
                $count = $service->getGroupPupilsCount($groupId);
                $pupils = $service->getGroupPupilsList($groupId);

                return view('groups.pupils', [
                    'count' => $count,
                    'pupils' => $pupils
                ]);
            }
        }

        return '';
    }

}
