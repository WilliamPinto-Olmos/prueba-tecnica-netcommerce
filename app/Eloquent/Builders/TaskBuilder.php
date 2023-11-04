<?php

namespace App\Eloquent\Builders;

use Illuminate\Database\Eloquent\Builder;

class TaskBuilder extends Builder
{
    public function pending(): self
    {
        return $this->whereIsCompleted(false);
    }
}