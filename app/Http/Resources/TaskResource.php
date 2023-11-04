<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $this->loadMissing(['user', 'company']);

        return [
            'id' => $this->id,
            'user' => $this->user->name,
            'company' => [
                'id' => $this->company_id,
                'name' => $this->name,
            ],
            'name' => $this->name,
            'description' => $this->description,
            'is_completed' => $this->is_completed,
            'start_at' => $this->start_at ? Carbon::parse($this->start_at)->format('Y-m-d H:i:s') : null,
            'expired_at' => $this->expired_at ? Carbon::parse($this->expired_at)->format('Y-m-d H:i:s') : null,
            'created_at' => $this->created_at ? Carbon::parse($this->created_at)->format('Y-m-d H:i:s') : null,
            'updated_at' => $this->updated_at ? Carbon::parse($this->updated_at)->format('Y-m-d H:i:s') : null,
        ];
    }
}
