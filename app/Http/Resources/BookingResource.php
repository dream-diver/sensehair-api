<?php

namespace App\Http\Resources;

use App\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
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
                'booking_time' => $this->updated_at->format('d/m/Y h:ia'),
                'charge' => $this->charge,

                'customer_id' => $this->customer_id,
                'server_id' => $this->server_id,

                'customer' => new UserResource($this->customer),
                'server' => new UserResource($this->server),

				'updated_at' => $this->updated_at->format('d/m/Y h:ia'),
				'created_at' => $this->created_at->format('d/m/Y h:ia'),
            ],
			'links' => [
				'self' => url($this->path())
			]
        ];
    }
}
