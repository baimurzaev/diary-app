<?php

namespace App\Http\Controllers;

use App\Services\Pupils\PupilsService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PupilsController extends Controller
{
    public function list(Request $request): View
    {
        $service = new PupilsService();

        return view('pupils.list', [
            'pupils' => $service->list()
        ]);
    }
}
