<?php

namespace App\Rules;

use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;

class PendingTaskRule implements ValidationRule, DataAwareRule
{
    /** 
     * Data from the validator.
     */
    protected array $data;

    /**
     * Set the data from the validator.
     */
    public function setData(array $data): static
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $newTaskHasPendingStatus = isset($this->data['is_completed']) && ($this->data['is_completed'] == '0');

        if (! $newTaskHasPendingStatus) return;

        $user = User::find($this->data['user_id']);

        if (! $user) {
            $fail('The user does not exist.');
        }

        $canCreatePendingTask = $user->can('create-pending-task');

        if (! $canCreatePendingTask) {
            $fail('The user has reached the limit (5) of pending tasks.');
        }
    }
}
