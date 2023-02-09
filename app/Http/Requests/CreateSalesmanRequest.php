<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

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
            'email' => ['unique:salesmen', 'required', 'email:rfc,dns'],
            'gender' => ['required', Rule::in('m', 'f')],
            'titles_before' => ['array', 'max:10'],
            'titles_before.*' => ['distinct', Rule::in(['Bc.', 'Mgr.', 'Ing.', 'JUDr.', 'MVDr.', 'MUDr.', 'PaedDr.', 'prof.', 'doc.', 'dipl.', 'MDDr.', 'Dr.', 'Mgr. art.', 'ThLic.', 'PhDr.', 'PhMr.', 'RNDr.', 'ThDr.', 'RSDr.', 'arch.', 'PharmDr.' ])],
            'titles_after' => ['array', 'max:10'],
            'titles_after.*' => ['distinct', Rule::in(['CSc.', 'DrSc.', 'PhD.', 'ArtD.', 'DiS', 'DiS.art', 'FEBO', 'MPH', 'BSBA', 'MBA', 'DBA', 'MHA', 'FCCA', 'MSc.', 'FEBU', 'LL.M'])],
            'marital_status' => [Rule::in(['single', 'married', 'divorced', 'widowed'])],
            'phone' => ['string']
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => array_map(function ($message) {
                return [
                    'code' => 'VALIDATION_ERROR', // TODO: set specific validation error code
                    'message' => $message
                ];
            }, $validator->errors()->all()),
        ], 400));
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
