<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\SpaceResource;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Image;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'Nombre' => $this->name,
            'email' => $this->email,
            'Identificaor del rol' => $this->role_id,
            'Teléfono' => $this->phone,
            'Apellido' => $this->lastName,
            'Cuando fue creado este usuario' => $this->created_at,
            'Cuando fue modificado' => $this->updated_at,
            'spaces' => SpaceResource::collection($this->whenLoaded('spaces')),
            'comments' => CommentResource::collection($this->whenLoaded('comments')),

        ];
    }

    public function with($request): array
    {
        return [
            'meta' => 'User ' . $this->name . ' mostrado correctamente'
        ];
    }
}
