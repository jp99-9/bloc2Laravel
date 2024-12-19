<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'identificador' => $this->id,
            'Comentario' => $this->comment,
            'Puntuación' => $this->score,
            'Usuario id' => $this->user_id,
            'Espacio id' => $this->space_id,
            'Status' => $this->status,
            'Imagen' => ImageResource::collection($this->whenLoaded('images')),
        ];
    }
}
