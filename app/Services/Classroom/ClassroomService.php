<?php

namespace App\Services\Classroom;

use App\Models\Classroom;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
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

    /**
     * @param array $params
     * @return int
     */
    public function createClassroom(array $params): int
    {
        $name = $params['name'];

        if ($name && mb_strlen($name) >= 2) {
            $classroom = Classroom::create([
                'name' => $name,
                'user_id' => Auth::id()
            ]);

            return $classroom->id;
        }

        return 0;
    }

    /**
     * @return Collection
     */
    public function getAll()
    {
        return DB::table('classrooms')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * @param array $params
     * @return bool
     */
    public function save(array $params)
    {
        $id = $params['id'];
        $name = $params['name'];

        if ($id > 0) {
            $classroom = Classroom::find($id);
            if ($classroom->id > 0) {
                $classroom->name = $name;
                $classroom->save();
                return true;
            }
        }
        return false;
    }
}
