<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'data' => [
                'id' => $this->id,
                'name' => $this->name,
                'name_en' => $this->name_en,
                'duration' => $this->duration,
                'category' => $this->category,
                'category_en' => $this->category_en,

                'stylist_price' => $this->stylist_price,
                'art_director_price' => $this->art_director_price,

                'hair_size' => $this->hair_size,
                'hair_type' => $this->hair_type,
                'hair_size_nl' => $this->hair_size_nl,
                'hair_type_nl' => $this->hair_type_nl,

				'updated_at' => $this->updated_at->format('d/m/Y h:ia'),
				'created_at' => $this->created_at->format('d/m/Y h:ia'),
            ],
			'links' => [
				'self' => url($this->path())
			]
        ];
    }
}
