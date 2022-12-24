<?php

namespace App\Services\Generate;

use App\Domain\Generate\GenerateUsers;
use App\Domain\Groups\Constants;
use App\Models\User;

class UsersService
{
    /**
     * @return void
     */
    public function createPupils(): void
    {
        $this->createUsers(
            GenerateUsers::create(20, Constants::PUPIL)
        );
    }

    /**
     * @return void
     */
    public function createTeachers(): void
    {
        $this->createUsers(
            GenerateUsers::create(2, Constants::TEACHER)
        );
    }

    /**
     * @param array $users
     * @return void
     */
    private function createUsers(array $users): void
    {
        foreach ($users as $user) {
            $userModel = new User();
            $userModel->append($user);
            $userModel->save();
        }
    }
}
