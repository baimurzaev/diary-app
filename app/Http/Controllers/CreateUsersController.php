<?php

namespace App\Http\Controllers;

use App\Models\AccountType;
use App\Models\User;
use Illuminate\Http\Request;

class CreateUsersController extends Controller
{
    public function createTypes()
    {
        $types = [
            ['id' => 1, 'name' => 'Учитель'],
            ['id' => 2, 'name' => 'Ученик'],
            ['id' => 3, 'name' => 'Админ'],
        ];

        foreach ($types as $type) {
            $account = new AccountType();
            $account->id = $type['id'];
            $account->name = $type['name'];
            $account->save();
        }
    }

    public function createUsers()
    {
        $user = new User();
        $user->login = 'sergey';
        $user->email = 'sergey@mail.ru';
        $user->last_name = 'Морозов';
        $user->first_name = 'Сергей';
        $user->middle_name = 'Алексеевич';
        $user->save();
    }
}
