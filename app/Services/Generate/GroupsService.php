<?php

namespace App\Services\Generate;

use App\Domain\Groups\Constants;
use App\Models\Group;

final class GroupsService
{
    public function createGroups(): void
    {
        foreach (Constants::$types as $key => $value) {
            $account = new Group();
            $account->$key = $value;
            $account->save();
        }
    }
}
