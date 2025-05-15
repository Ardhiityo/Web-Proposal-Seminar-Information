<?php

namespace App\Http\Requests\AcademicCalendar;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAcademicCalendarRequest extends FormRequest
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
            'started_date' => ['required', 'date', 'before:ended_date', 'after:yesterday', Rule::unique('academic_calendars', 'started_date')->ignore($this->academic_calendar)],
            'ended_date' => ['required', 'date', 'after:started_date', Rule::unique('academic_calendars', 'ended_date')->ignore($this->academic_calendar)],
        ];
    }
}
