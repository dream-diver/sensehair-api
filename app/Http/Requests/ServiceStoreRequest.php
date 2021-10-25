<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ServiceStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->hasPermissionTo('services.create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'duration' => ['required', 'string'],

            'stylist_price' => ['required', 'string'],
            'art_director_price' => ['required', 'string'],

            'hair_size' => ['required', 'string'],
            'hair_type' => ['string', 'nullable'],
        ];
    }
}
