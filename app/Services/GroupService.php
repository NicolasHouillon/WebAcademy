<?php

namespace App\Services;

use App\Models\Group;
use App\Models\User;

class GroupService
{

    /**
     * @param string $name
     * @return array
     */
    public function getUsersFromGroup(string $name)
    {
        return User::where('group_id', Group::where('name', $name)->pluck('id')->first())->get();
    }

}
