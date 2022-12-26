<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PupilsController extends Controller
{
    public function list()
    {
        return view('pupils.list', [
            'pupils' => User::latest()->where('group_id', '=', 2)->paginate(30)->withQueryString()
        ]);

    }
}
