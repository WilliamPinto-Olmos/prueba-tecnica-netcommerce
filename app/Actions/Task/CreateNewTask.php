<?php

namespace App\Actions\Task;

use App\DTO\TaskDTO;
use App\Models\Task;
use App\Rules\PendingTaskRule;
use Illuminate\Support\Facades\Validator;

final class CreateNewTask 
{
    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create(TaskDTO $input): Task
    {
        Validator::make($input->toArray(), [
            'name' => 'required|string|max:50',
            'description' => 'nullable|string|max:500',
            'user_id' => 'required|integer|exists:users,id',
            'company_id' => 'required|integer|exists:companies,id',
            'is_completed' => ['required', 'boolean', new PendingTaskRule()],
            'start_at' => 'nullable|date_format:Y-m-d H:i:s',
            'expired_at' => 'nullable|date_format:Y-m-d H:i:s',
        ])->validate();

        return Task::create([
            'name' => $input->name,
            'description' => $input->description ?? '',
            'user_id' => $input->user_id,
            'company_id' => $input->company_id,
            'is_completed' => $input->is_completed ?? false,
            'start_at' => $input->start_at ?? null,
            'expired_at' => $input->expired_at ?? null,
        ]);
    }
}