<?php

namespace App\Policies;

use App\User;
use App\Task;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy extends BasePolicy
{
    use HandlesAuthorization, HasAdmin;

    /**
     * Determine whether the user can list the task.
     *
     * @param  \App\User  $user
     * @param  \App\Task  $task
     * @return mixed
     */



    public function model()
    {
        return 'task';
    }
}
