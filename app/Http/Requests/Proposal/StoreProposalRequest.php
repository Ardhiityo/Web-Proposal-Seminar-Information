<?php

namespace App\Http\Requests\Proposal;

use Illuminate\Foundation\Http\FormRequest;

class StoreProposalRequest extends FormRequest
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
            'session_time' => ['required'],
            'session_date' => ['required', 'after:yesterday'],
            'student_id' => ['required', 'exists:students,id'],
            'academic_calendar_id' => ['required', 'exists:academic_calendars,id'],
            'room_id' => ['required', 'exists:rooms,id'],
            'examiner_1_id' => ['required', 'exists:lectures,id'],
            'examiner_2_id' => ['required', 'exists:lectures,id', 'different:examiner_1_id'],
            'moderator_id' => ['required', 'exists:lectures,id'],
        ];
    }
}
