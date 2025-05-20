<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Room;
use App\Models\Lecture;
use App\Models\Student;
use App\Models\ProposalStatus;
use App\Models\AcademicCalendar;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    protected $fillable = [
        'student_id',
        'session_time',
        'session_date',
        'room_id',
        'academic_calendar_id'
    ];

    public function getSessionDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function getRawSessionDateAttribute()
    {
        return $this->attributes['session_date'];
    }

    public function getSessionTimeAttribute($value)
    {
        return Carbon::parse($value)->format('H:i');
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function academicCalendar()
    {
        return $this->belongsTo(AcademicCalendar::class);
    }
}
