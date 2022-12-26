<?php

namespace App\Services\Pupils;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;


class GroupPupilsService
{
    /**
     * @param int $groupId
     * @return int
     */
    public function getGroupPupilsCount(int $groupId): int
    {
        return DB::table('group_pupils_links')
            ->where('group_id', '=', $groupId)
            ->count();
    }

    /**
     * @param $groupId
     * @return Collection
     */
    public function getGroupPupilsList($groupId): Collection
    {
        return DB::table('group_pupils_links as gpl')
            ->leftJoin('users as u', 'gpl.user_id', '=', 'u.id')
            ->where("gpl.group_id", '=', $groupId)
            ->get();
    }
}
