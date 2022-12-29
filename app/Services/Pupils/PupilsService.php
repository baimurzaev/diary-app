<?php

namespace App\Services\Pupils;

use App\Models\SchedulesTmpl;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class PupilsService
{

    /**
     * @var int
     */
    public $paginate = 15;

    /**
     * @param $num
     * @return $this
     */
    public function paginate($num): self
    {
        $this->paginate = $num;

        return $this;
    }

    /**
     * @return mixed
     */
    public function list()
    {
        return User::latest()
            ->where('group_id', '=', 2)
            ->paginate($this->paginate)
            ->withQueryString();
    }

    /**
     * @param array $params
     * @return int
     */
    public function unlink(array $params): int
    {
        $userId = (int)$params['user_id'];
        $classroomId = (int)$params['classroom_id'];

        if ($userId > 0 && $classroomId > 0) {
            $pupil = User::find($userId);
            $pupil->schedule_id = 0;
            $pupil->save();

            $res = DB::table('classroom_users')
                ->where('user_id', '=', $userId)
                ->where('classroom_id', '=', $classroomId)
                ->delete();

            $this->makeCount($classroomId);

            return $res;
        }

        return 0;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function search(Request $request)
    {
        $term = $request->get('query');

        $results = DB::table('users')
            ->select(['id', 'name', 'middle_name', 'last_name'])
            ->where('group_id', '=', 2)
            ->where(function ($query) use ($term) {
                $query->orWhere('name', 'LIKE', "%$term%")
                    ->orWhere('last_name', 'LIKE', "%$term%")
                    ->orWhere('middle_name', 'LIKE', "%$term%");
            })->get();

        $data = [];

        foreach ($results as $row) {
            $data[] = [
                "value" => $row->last_name . ' ' . $row->name . ' ' . $row->middle_name,
                "data" => [
                    "id" => $row->id,
                    "name" => $row->name
                ]
            ];
        }

        return json_encode(['suggestions' => $data]);
    }

    /**
     * @param array $params
     * @return bool
     */
    public function link(array $params): bool
    {
        $userId = (int)$params['user_id'];
        $classroomId = (int)$params['classroom_id'];

        if ($userId > 0 && $classroomId > 0) {
            DB::table('classroom_users')->insert([
                'user_id' => $userId,
                'classroom_id' => $classroomId
            ]);
            $this->makeCount($classroomId);
            return true;
        }

        return false;
    }

    /**
     * @param int $id
     * @return void
     */
    public function makeCount(int $id): void
    {
        DB::table('classrooms')
            ->where('id', '=', (int)$id)
            ->update(['pupils_count' => DB::table('classroom_users')
                ->where('classroom_id', '=', (int)$id)
                ->count()]);
    }

    /**
     * @param array $params
     * @return bool
     */
    public function addGroup(array $params): bool
    {
        $scheduleId = $params['schedule_id'];
        $ids = $params['users'];
        $schedule = SchedulesTmpl::find($scheduleId);

        if ($schedule->id > 0) {
            foreach ($ids as $id) {
                $pupil = User::find($id);
                $pupil->schedule_id = $scheduleId;
                $pupil->save();
            }

            return true;
        }

        return false;
    }
}
