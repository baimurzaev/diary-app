<?php

namespace App\Services\Subjects;

use App\Models\Subject;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SubjectsService
{
    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return DB::table('subjects')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * @param $params
     * @return bool
     */
    public function createSubject($params): bool
    {
        $name = $params['name'];
        $minutes = $params['num_minutes'];

        if (mb_strlen($name) >= 2) {
            Subject::create([
                'name' => $name,
                'num_minutes' => $minutes,
                'user_id' => Auth::id()
            ]);

            return true;
        }

        return false;
    }

    /**
     * @param array $params
     * @return bool
     */
    public function editSubject(array $params): bool
    {
        $id = (int)$params['id'];
        $name = $params['name'];
        $minutes = $params['num_minutes'];

        if ($id > 0 && mb_strlen($name) >= 2) {
            $subject = Subject::find($id);
            $subject->name = $name;
            $subject->num_minutes = $minutes;
            $subject->save();

            return true;
        }

        return false;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function byId(int $id)
    {
        return Subject::find($id);
    }
}
