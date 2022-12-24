<?php

namespace App\Services\Generate;

use App\Domain\Generate\Constants;
use App\Models\Classroom;

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
}
