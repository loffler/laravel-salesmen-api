<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateSalesmanRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => ['required', 'min:2', 'max:50'],
            'last_name' => ['required', 'min:2', 'max:50'],
            'prosight_id' => ['required', 'digits:5'],
            'email' => ['required', 'email:rfc,dns'],
            'gender' => ['required'],
            'titles_before' => ['array'],
            'titles_before.*' => ['string', 'distinct', 'min:3'],
            'titles_after' => ['array'],
            'titles_after.*' => ['string', 'distinct', 'min:3'],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message'   => 'Validation error',
            'data'      => $validator->errors()
        ]));
    }

    public function passedValidation()
    {
        $extraFields = $this->except(array_keys($this->rules()));
        if (count($extraFields) > 0) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message'   => 'Extra fields in request body',
                'data'      => join(', ', $extraFields),
            ]));
        }
    }
}
