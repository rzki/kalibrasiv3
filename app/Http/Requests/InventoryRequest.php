<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InventoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'device_name'   => 'required',
            'brand'         => 'required',
            'type'          => 'required',
            'sn'            => 'required',
            'inv_number'    => 'required',
            'procurement_year'=> 'required',
            'last_calibrated_date' => 'required',
            'pic'           => 'required',
            'location'      => 'required',
            'status'        => 'required'
        ];
    }

}
