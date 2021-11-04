<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BookingUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->hasPermissionTo('bookings.update');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'booking_time' => ['string', 'nullable'],
            'charge' => ['numeric', 'nullable'],
            'duration' => ['integer', 'nullable'],
            'name' => ['string', 'nullable'],
            'email' => ['string', 'nullable'],
            'phone' => ['string', 'nullable'],

            'customer_id' => ['integer', 'nullable'],
            'server_id' => ['integer', 'nullable'],
            'stripe_client_secret' => ['string', 'nullable'],
            'stripe_id' => ['string', 'nullable'],
            'payment_status' => ['string', 'nullable'],
            'promocode' => ['string', 'nullable'],
            'services' => ['array', 'nullable'],
        ];
    }
}
