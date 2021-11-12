<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => [
                'id' => $this->id,
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'avatar_path' => $this->avatar_path,
                'role' => $this->roles()->first()->name,
                'pivot' => $this->pivot,

				'updated_at' => $this->updated_at->format('d/m/Y h:ia'),
				'created_at' => $this->created_at->format('d/m/Y h:ia'),
            ],
			'links' => [
				'self' => url($this->path())
			]
        ];
    }
}
