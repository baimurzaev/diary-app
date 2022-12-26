<?php

namespace App\Http\Controllers;

use App\Models\GroupPupil;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function pupilsList(Request $request)
    {
        $id = (int)$request->id;

        if ($id > 0) {
            if (GroupPupil::find($id)) {

                $count = DB::table('group_pupils_links')
                    ->where('group_id', '=', $id)
                    ->count();

                // @todo вынести из контроллера в сервис
                $pupils = DB::table('group_pupils_links as gpl')
                    ->leftJoin('users as u', 'gpl.user_id', '=', 'u.id')
                    ->where("gpl.group_id", '=', $id)
                    ->get();

                return view('groups.pupils', [
                    'count' => $count,
                    'pupils' => $pupils
                ]);
            }
        }

        return '';
    }

}
