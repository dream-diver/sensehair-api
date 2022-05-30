<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'booking_time' => ['required', 'string'],
            'charge' => ['required', 'numeric'],
            'duration' => ['required', 'integer'],
            'name' => ['string', 'nullable'],
            'email' => ['string', 'nullable'],
            'phone' => ['string', 'nullable'],

            'customer_id' => ['integer', 'nullable'],
            'server_id' => ['required', 'integer'],
            'stripe_client_secret' => ['string', 'nullable'],
            'stripe_id' => ['string', 'nullable'],
            'promocode' => ['string', 'nullable'],
            'services' => ['required', 'array'],
            // 'sendEmailAndSms' => ['required'],
        ];
    }
}
