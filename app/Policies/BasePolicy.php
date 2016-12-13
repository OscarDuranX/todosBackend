<?php
/**
 * Created by PhpStorm.
 * User: oscar
 * Date: 13/12/16
 * Time: 21:49
 */

namespace App\Policies;

use App\Task;
use App\User;

/**
 * Class BasePolicy
 * @package App\Policies
 */

class BasePolicy
{

    public function show(User $user)
    {
        if($user->hasRole('admin')) return true;
        return false;
    }



    public function view(User $user, Task $task)
    {
        if($user ->hasPermissionTo('view-'. $this->model())) return true;
    }

    /**
     * Determine whether the user can create tasks.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if($user ->hasPermissionTo('create-'. $this->model())) return true;
    }

    /**
     * Determine whether the user can update the task.
     *
     * @param  \App\User  $user
     * @param  \App\Task  $task
     * @return mixed
     */
    public function update(User $user, Task $task)
    {
        if($user ->hasPermissionTo('update-'. $this->model())) return true;
        if($user->isAdmin()) return true;
        if($user->hasRole('editor')) return true;
        return $user->id == $task->user_id;
    }

    /**
     * Determine whether the user can delete the task.
     *
     * @param  \App\User  $user
     * @param  \App\Task  $task
     * @return mixed
     */
    public function delete(User $user, Task $task)
    {
        if($user->hasPermissionTo('delete-' . $this->model())) return true;
    }

}