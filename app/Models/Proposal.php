<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Room;
use App\Models\Lecture;
use App\Models\Student;
use App\Models\AcademicCalendar;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    protected $fillable = [
        'student_id',
        'session_time',
        'session_date',
        'room_id',
        'academic_calendar_id',
        'examiner_1_id',
        'examiner_2_id',
        'moderator_id',
    ];

    public function getSessionDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function getRawSessionDateAttribute()
    {
        return $this->attributes['session_date'];
    }

    public function getSessionMonthAttribute()
    {
        return Carbon::parse($this->attributes['session_date'])->format('F');
    }

    public function getSessionMonthNumberAttribute()
    {
        return Carbon::parse($this->attributes['session_date'])->format('m');
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

    public function examiner1()
    {
        return $this->belongsTo(Lecture::class, 'examiner_1_id');
    }

    public function examiner2()
    {
        return $this->belongsTo(Lecture::class, 'examiner_2_id');
    }

    public function moderator()
    {
        return $this->belongsTo(Lecture::class, 'moderator_id');
    }
}
