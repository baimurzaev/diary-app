<?php

namespace App\Services\Generate;

use App\Domain\Groups\Constants;
use App\Models\Group;

final class GroupsService
{
    public function createGroups(): void
    {
        foreach (Constants::$types as $name) {
            $group = new Group();
            $group->name = $name;
            $group->save();
        }
    }
}
