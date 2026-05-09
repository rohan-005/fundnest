<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ScholarshipResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'              => $this->id,
            'title'           => $this->title,
            'description'     => $this->description,
            'amount'          => $this->amount,
            'amount_formatted'=> '₹' . number_format($this->amount),
            'deadline'        => $this->deadline?->toDateString(),
            'days_left'       => $this->daysUntilDeadline(),
            'eligibility'     => $this->eligibility,
            'available_slots' => $this->available_slots,
            'is_active'       => $this->is_active,
            'is_expired'      => $this->isExpired(),
            'category'        => $this->whenLoaded('category', fn() => [
                'id'   => $this->category->id,
                'name' => $this->category->name,
                'slug' => $this->category->slug,
            ]),
            'created_at'      => $this->created_at->toDateString(),
        ];
    }
}
