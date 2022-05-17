<?php

namespace App\Http\Resources;

use App\Http\Resources\PromocodeResource;
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
        $bookingResource = [
            'data' => [
                'id' => $this->id,
                'booking_time' => $this->booking_time->format('Y-m-d H:i'),
                'charge' => $this->charge,
                'duration' => $this->duration,
                'payment_status' => $this->payment_status,
                'category' => $this->category,
                'category_en' => $this->category_en,

                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,

                'customer_id' => $this->customer_id,
                'server_id' => $this->server_id,
                'promocode_id' => $this->promocode_id,

                'customer' => new UserResource($this->customer),
                'server' => new UserResource($this->server),
                'promocode' => new PromocodeResource($this->promocode),

				'updated_at' => $this->updated_at->format('d/m/Y h:ia'),
				'created_at' => $this->created_at->format('d/m/Y h:ia'),
            ],
			'links' => [
				'self' => url($this->path())
			]
        ];
        if ($this->relationLoaded('services')) {
            $bookingResource['data'] = array_merge($bookingResource['data'], ['services' => ServiceResource::collection($this->services)]);
        }

        return $bookingResource;
    }
}
