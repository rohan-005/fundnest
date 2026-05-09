<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApplicationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'status'       => $this->status,
            'message'      => $this->message,
            'admin_remark' => $this->admin_remark,
            'scholarship'  => $this->whenLoaded('scholarship', fn() => new ScholarshipResource($this->scholarship)),
            'documents'    => $this->whenLoaded('documents', fn() => $this->documents->map(fn($d) => [
                'id'   => $d->id,
                'name' => $d->document_name,
            ])),
            'created_at'   => $this->created_at->toDateString(),
        ];
    }
}
