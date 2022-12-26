<?php

namespace App\Services\Classroom;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ClassroomService
{

    /**
     * @param int $classroomId
     * @return int
     */
    public function getClassroomUsersCount(int $classroomId): int
    {
        return DB::table('classroom_users')
            ->where('classroom_id', '=', $classroomId)
            ->count();
    }

    /**
     * @param int $classroomId
     * @return Collection
     */
    public function getClassroomPupils(int $classroomId): Collection
    {
        return DB::table('classroom_users as cu')
            ->leftJoin('users as u', 'cu.user_id', '=', 'u.id')
            ->where("cu.classroom_id", '=', $classroomId)
            ->get();
    }
}
