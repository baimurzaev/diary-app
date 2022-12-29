<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function show(Request $request)
    {
        $groups = [];
        foreach (Group::all() as $group) {
            $groups[$group->id] = $group->name;
        }

        return view('user.profile', [
            'profile' => Auth::user(),
            'accountType' => $groups[Auth::user()->group_id]
        ]);
    }
}
