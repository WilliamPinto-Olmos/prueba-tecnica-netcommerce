<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserTaskPolicy
{
    /**
     * Determines if a given user can create a new task
     * with 'is_completed' field as false.
     */
    public function createPendingTask(User $user): Response
    {
        return $user->tasks()->pending()->count() < 5 
            ? Response::allow()
            : Response::deny('Se ha excedido el límite de tareas pendientes.');
    }
}
