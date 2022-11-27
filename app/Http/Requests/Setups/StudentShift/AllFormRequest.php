<?php

namespace App\Http\Requests\Setups\StudentShift;

use Illuminate\Foundation\Http\FormRequest;

class AllFormRequest extends FormRequest
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
            'name' => 'required|unique:student_shifts,name',
        ];
    }
}
