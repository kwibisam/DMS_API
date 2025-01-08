<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DocumentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'path' => $this->path,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'tags' => $this->tags->pluck('name'), // Get a list of tag names
        ];
    }
}
