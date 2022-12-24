<?php

namespace App\Services\Generate;

use App\Domain\Generate\GenerateUsers;
use App\Domain\Groups\Constants;
use App\Models\User;

class UsersService
{
    /**
     * @param $amount
     * @return void
     */
    public function createPupils($amount): void
    {
        $this->createUsers(
            GenerateUsers::generate($amount, Constants::GROUP_PUPIL)
        );
    }

    /**
     * @param $amount
     * @return void
     */
    public function createTeachers($amount): void
    {
        $this->createUsers(
            GenerateUsers::generate($amount, Constants::GROUP_TEACHER)
        );
    }

    /**
     * @param array $users
     * @return void
     */
    private function createUsers(array $users): void
    {
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
