<?php

namespace App\Models;

use App\Eloquent\Builders\TaskBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'description',
        'user_id',
        'company_id',
        'is_completed',
        'start_at',
        'expired_at',
    ];

    /**
     * Register a custom builder for the model.
     */
    public function newEloquentBuilder($query): Builder
    {
        return new TaskBuilder($query);
    }

    /**
     * A task belongs to a user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A task belongs to a company.
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
