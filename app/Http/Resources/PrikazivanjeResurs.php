<?php

namespace App\Http\Resources;

use App\Models\FilmModel;
use App\Models\Sala;
use Illuminate\Http\Resources\Json\JsonResource;

class PrikazivanjeResurs extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $sala = Sala::find($this->salaID);
        $film = FilmModel::find($this->filmID);

        return [
            'id' => $this->id,
            'dan' => $this->dan,
            'film' => $film->nazivFilma,
            'sala' => $sala->nazivSale
        ];
    }
}
