<?php

namespace App\Services\Pupils;

use App\Models\User;

class PupilsService
{

    public function list()
    {
        return User::latest()->where('group_id', '=', 2)
            ->paginate(30)->withQueryString();
    }
}
