<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    public function __construct(
        mixed $resource, 
        public bool $withTasks = false
    ) {
        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $baseCase = [
            'id' => $this->id,
            'name' => $this->name,
        ];

        if (! $this->withTasks) return $baseCase;

        return [
            ...$baseCase,
            'tasks' => TaskResource::collection($this->whenLoaded('tasks')),
        ];
    }
}
