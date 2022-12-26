<?php

namespace App\Services\Schedules;

use App\Models\Schedule;
use App\Models\ScheduleLesson;
use Illuminate\Support\Facades\Auth;

class SchedulesService
{
    /**
     * @var array
     */
    private array $params;

    /**
     * @param array $params
     */
    public function __construct(array $params = [])
    {
        $this->params = $params;
    }

    public function createSchedule()
    {
        $schedule = Schedule::create([
            'name' => $this->params['name'],
            'time_start' => $this->params['time_start'],
            'classroom_id' => $this->params['classroom_id'],
            'user_id' => Auth::id()
        ]);

        $days = $this->groupByDays($schedule, $this->params['lessons']);

        print_r($days);
        exit;
    }

    /**
     * @param Schedule $schedule
     * @param array $lessons
     * @return array
     */
    private function groupByDays(Schedule $schedule, array $lessons): array
    {
        $data = [];

        foreach ($lessons as $lesson) {
            $lessons[$lesson['day']][] = [
                'title' => $lesson['title'],
                'time_start' => $lesson['time_start'],
                'homework' => '',
                'subject_id' => $schedule->subject_id,
                'schedule_id' => $schedule->id,
                'day_num' => $lesson['day'],
            ];
        }

        return $data;
    }
}
