<?php

namespace App\Services\Generate;

use App\Domain\Generate\Constants;
use App\Models\Subject;

class SubjectsService
{
    /**
     * @return void
     */
    public function create(): void
    {
        foreach (Constants::SUBJECTS as $subject) {
            Subject::create([
                'name' => $subject['name'],
                'num_minutes' => $subject['time']
            ]);
        }
    }
}
