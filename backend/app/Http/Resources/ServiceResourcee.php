<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResourcee extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'tipo'=>$this->tipo,
            'descricao'=>$this->descricao,
            'duracao'=> Carbon::parse($this->duracao)->format('H:i')
        ];
    }
}
