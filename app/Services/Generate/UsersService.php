<?php

namespace App\Services\Generate;

use App\Domain\Generate\Constants as ConstantsGenerate;
use App\Domain\Generate\GenerateUsers;
use App\Domain\Groups\Constants;
use App\Models\ClassroomUser;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UsersService
{
    /**
     * @param int $amount
     * @param int $genderType
     * @return void
     */
    public function createPupils(int $amount, int $genderType): void
    {
        $this->createUsers(
            GenerateUsers::generate($amount, Constants::GROUP_PUPIL, $genderType)
        );
    }

    /**
     * @param int $amount
     * @param int $genderType
     * @return void
     */
    public function createTeachers(int $amount, int $genderType): void
    {
        $this->createUsers(
            GenerateUsers::generate($amount, Constants::GROUP_TEACHER, $genderType)
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

    /**
     * @param int $classroomId
     * @return void
     */
    public function generatePupilsForClassroom(int $classroomId): void
    {
        // Add males
        $this->addPupilsToClassroom(
            GenerateUsers::generate(15, Constants::GROUP_PUPIL, ConstantsGenerate::GENDER_MALE),
            $classroomId
        );

        // Add females
        $this->addPupilsToClassroom(
            GenerateUsers::generate(15, Constants::GROUP_PUPIL, ConstantsGenerate::GENDER_FEMALE),
            $classroomId
        );
    }

    /**
     * @param $pupils
     * @param $classroomId
     * @return void
     */
    public function addPupilsToClassroom($pupils, $classroomId): void
    {
        foreach ($pupils as $pupil) {
            $user = User::create($pupil);

            // create link
            DB::table('classroom_users')->insert([
                'user_id' => $user->id,
                'classroom_id' => $classroomId
            ]);


        }
    }
}
