<?php

namespace App\Services\Schedules;

use App\Domain\Schedules\Constants;
use App\Models\ScheduleLessonsTmpl;
use App\Models\SchedulesTmpl;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

final class SchedulesService
{
    /**
     * @var array
     */
    protected array $params;

    /**
     * @param array $params
     */
    public function __construct(array $params = [])
    {
        $this->params = $params;
    }

    /**
     * @param $params
     * @return bool
     */
    public function createSchedule($params): bool
    {
        DB::beginTransaction();

        try {
            $schedule = SchedulesTmpl::create([
                'user_id' => Auth::id(),
                'name' => $params['name'],
                'time_start' => $params['time_start']
            ]);

            if ((int)$schedule->id > 0 && count($params['lessons']) > 0) {
                $this->createScheduleLessons($schedule, $params['lessons']);
            }

            DB::commit();
        } catch (\Throwable $e) {
            echo $e->getMessage();
            DB::rollBack();

            return false;
        }

        return true;
    }

    /**
     * @return array
     */
    public function getScheduleData(): array
    {
        $scheduleId = (int)Auth::user()->schedule_id;

        if ($scheduleId > 0) {
            $schedule = SchedulesTmpl::find($scheduleId);

            if ((int)$schedule->id <= 0) {
                return [];
            }

            return [
                'schedule' => $schedule,
                'lessons' => $this->getScheduleLessons($schedule->id),
                'week' => Constants::WEEK_DAYS,
                'days' => $this->getNumDays()
            ];
        }

        return [];
    }

    /**
     * @param array $params
     * @return bool
     */
    public function editSchedule(array $params): bool
    {
        $id = (int)$params['id'];

        if ($id <= 0) {
            return false;
        }

        $schedule = SchedulesTmpl::find($id);

        if ($schedule->id > 0) {
            DB::beginTransaction();

            try {
                if (isset($params['name']) && mb_strlen($params['name']) >= 2) {
                    $schedule->name = $params['name'];
                }

                if (isset($params['time_start']) && mb_strlen($params['time_start']) >= 2) {
                    $schedule->time_start = $params['time_start'];
                }

                $schedule->save();

                if (count($params['lessons']) > 0) {
                    DB::table('schedule_lessons_tmpls')
                        ->where('schedule_id', '=', $schedule->id)
                        ->delete();

                    $this->createScheduleLessons($schedule, $params['lessons']);
                }

                DB::commit();
            } catch (\Throwable $e) {
                DB::rollBack();
                return false;
            }
        }

        return true;
    }

    /**
     * @param SchedulesTmpl $schedule
     * @param array $lessons
     * @return void
     */
    private function createScheduleLessons(SchedulesTmpl $schedule, array $lessons): void
    {
        $days = [];

        foreach ($lessons as $lesson) {
            $days[$lesson['day']][] = [
                'title' => $lesson['title'],
                'num_minutes' => $lesson['num_minutes'],
                'schedule_id' => $schedule->id,
                'day_num' => $lesson['day']
            ];
        }

        foreach ($days as $lessons) {
            foreach ($lessons as $pos => $lesson) {
                ScheduleLessonsTmpl::create([
                    'title' => $lesson['title'],
                    'schedule_id' => $lesson['schedule_id'],
                    'num_minutes' => (int)$lesson['num_minutes'],
                    'day_num' => $lesson['day_num'],
                    'position' => ($pos + 1)
                ]);
            }
        }
    }

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return DB::table('schedules_tmpls')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * @return array
     */
    public function getAllForSelect(): array
    {
        $data = [];

        foreach ($this->getAll() as $row) {
            $data[$row->id] = $row->name;
        }

        return $data;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getScheduleTmpl($id)
    {
        return SchedulesTmpl::find($id);
    }

    /**
     * @param int $id
     * @return array
     */
    public function getScheduleLessons(int $id): array
    {
        $results = DB::table('schedule_lessons_tmpls')
            ->where('schedule_id', '=', $id)
            ->orderBy('position')
            ->get();

        $lessons = array_fill(1, 7, []);

        foreach ($results as $result) {
            $lessons[$result->day_num][] = $result;
        }

        return $lessons;
    }

    /**
     * @param array $params
     * @return bool
     */
    public function delete(array $params): bool
    {
        $id = (int)$params['id'];
        if ($id > 0) {
            $schedule = SchedulesTmpl::find($id);

            if ($schedule->id > 0 && $schedule->user_id == Auth::id()) {
                DB::beginTransaction();

                try {
                    $schedule->delete();

                    DB::table('schedule_lessons_tmpls')
                        ->where('schedule_id', '=', $id)
                        ->delete();
                    DB::commit();
                } catch (\Throwable $e) {
                    DB::rollBack();
                }

                return true;
            }
        }

        return false;
    }

    public function createDouble(array $params)
    {
        $id = $params['id'];
        $schedule = SchedulesTmpl::find($id);

        if ($schedule->id > 0) {
            $scheduleDouble = new SchedulesTmpl();
            $scheduleDouble->name = $schedule->name;
            $scheduleDouble->user_id = $schedule->user_id;
            $scheduleDouble->time_start = $schedule->time_start;
            $scheduleDouble->save();

            if ($scheduleDouble->id > 0) {
                $results = DB::table('schedule_lessons_tmpls')
                    ->where('schedule_id', '=', $schedule->id)
                    ->get();

                foreach ($results as $row) {
                    $slt = new ScheduleLessonsTmpl();
                    $slt->title = $row->title;
                    $slt->schedule_id = $scheduleDouble->id;
                    $slt->day_num = $row->day_num;
                    $slt->position = $row->position;
                    $slt->num_minutes = $row->num_minutes;
                    $slt->save();
                }

                return true;
            }
        }

        return false;
    }

    private function getNumDays()
    {
        $date = strtotime('monday this week');

        $dates = [];

        for ($i = 0; $i < 7; $i++) {
            $dates[$i+1] = date("d", strtotime('+' . $i . ' day', $date));
        }

        return $dates;
    }
}
