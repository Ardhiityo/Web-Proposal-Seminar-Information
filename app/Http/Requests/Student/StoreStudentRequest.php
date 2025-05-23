<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'nim' => ['required', 'string', 'max:255', 'unique:students,nim'],
            'lecture_1_id' => ['required', 'exists:lectures,id'],
            'lecture_2_id' => ['required', 'exists:lectures,id', 'different:lecture_1_id'],
        ];
    }
}
