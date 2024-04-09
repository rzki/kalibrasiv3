<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
            'name' => 'required',
            'nid' => 'required',
            'type' => 'required',
            'status' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'employee_dept_id' => 'required|integer',
            'employee_position_id' => 'required|integer'
        ];
    }
}
