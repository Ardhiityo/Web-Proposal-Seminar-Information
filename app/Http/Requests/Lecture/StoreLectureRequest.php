<?php

namespace App\Http\Requests\Lecture;

use Illuminate\Foundation\Http\FormRequest;

class StoreLectureRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'phone' => 'required|numeric|digits_between:10,15|starts_with:08',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama dosen tidak boleh kosong',
            'name.string' => 'Nama dosen harus berupa string',
            'name.max' => 'Nama dosen tidak boleh lebih dari 255 karakter',
            'phone.required' => 'Narahubung tidak boleh kosong',
            'phone.numeric' => 'Narahubung harus berupa angka',
            'phone.digits_between' => 'Narahubung harus terdiri dari 10 hingga 15 digit',
            'phone.starts_with' => 'Narahubung harus diawali dengan 08',
        ];
    }
}
