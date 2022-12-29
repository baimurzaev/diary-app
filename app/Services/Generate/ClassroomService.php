<?php

namespace App\Services\Generate;

use App\Domain\Generate\Constants;
use App\Models\Classroom;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ClassroomService
{
    /**
     * @return void
     */
    public function create(): void
    {
        foreach (Constants::CLASSROOMS as $name) {
            $classroom = new Classroom();
            $classroom->name = $name;
            $classroom->save();
        }
    }

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return DB::table('classrooms')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * @return array
     */
    public function getPupilsCount(): array
    {
        $classrooms = [];

        foreach ($this->getAll() as $classroom) {
            $classrooms[$classroom->id] = $classroom->pupils_count;
        }

        return $classrooms;
    }

    public function getClassroom($id)
    {
        return Classroom::find($id);
    }
}
