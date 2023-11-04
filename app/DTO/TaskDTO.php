<?php

namespace App\DTO;

use Carbon\Carbon;

final readonly class TaskDTO
{
    public function __construct(
        public string $name,
        public ?string $description,
        public string $user_id,
        public string $company_id,
        public ?bool $is_completed,
        public ?Carbon $start_at,
        public ?Carbon $expired_at,
    ){}

    /**
     * Create a new instance of the DTO.
     */
    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            description: $data['description'] ?? null,
            user_id: strval($data['user_id']),
            company_id: strval($data['company_id']),
            is_completed: boolval($data['is_completed']) ?? null,
            start_at: isset($data['start_at']) ? Carbon::parse($data['start_at']) : null,
            expired_at: isset($data['expired_at']) ? Carbon::parse($data['expired_at']) : null,
        );
    }

    /**
     * Convert the DTO to an array.
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description ?? null,
            'user_id' => $this->user_id,
            'company_id' => $this->company_id,
            'is_completed' => $this->is_completed ?? null,
            'start_at' => $this->start_at ? $this->start_at->format('Y-m-d H:i:s') : null,
            'expired_at' => $this->expired_at ? $this->expired_at->format('Y-m-d H:i:s') : null,
        ];
    }
}