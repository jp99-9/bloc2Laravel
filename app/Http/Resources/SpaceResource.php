<?php

namespace App\Http\Resources;

use App\Models\Space;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use PhpParser\Node\Expr\AssignOp\Mod;
use App\Http\Resources\AddressResource;
use App\Http\Resources\CommentResource;
use App\Http\Resources\ServiceResource;
use App\Http\Resources\ModalityResource;
use App\Http\Resources\SpaceTypeResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SpaceResource extends JsonResource
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
            'Número de registro' => $this->regNumber,
            'Observación en catalán' => $this->observation_ca,
            'email' => $this->email,
            'Teléfono' => $this->phone,
            'Sitio web' => $this->website,
            'Tipo de acceso' => $this->accesType,
            'Puntuación total' => $this->totalScore,
            'Número de puntuaciones' => $this->countScore,
            'Dirección id' => $this->address_id,
            'Usuario id' => $this->user_id,
            'Tipo de espacio id' => $this->space_type_id,
            'Dirección' => new AddressResource($this->whenLoaded('address')),
            'Comentarios' => CommentResource::collection($this->whenLoaded('comments')),
            'Servicios' => ServiceResource::collection($this->whenLoaded('services')),
            'Modalidades' => ModalityResource::collection($this->whenLoaded('modalities')),
            'Tipo de espacio' => SpaceTypeResource::collection($this->whenLoaded('spaceType')),
            'Usuario'=> new UserResource($this->whenLoaded('user'))

        ];
    }
}
