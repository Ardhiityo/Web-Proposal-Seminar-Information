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
        'lecture_1_id',
        'lecture_2_id',
        'room_id',
        'academic_calendar_id'
    ];

    public function getSessionTimeAttribute($value)
    {
        return Carbon::parse($value)->format('H:i');
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function lecture1()
    {
        return $this->belongsTo(Lecture::class, 'lecture_1_id');
    }

    public function lecture2()
    {
        return $this->belongsTo(Lecture::class, 'lecture_2_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function proposalStatuses()
    {
        return $this->hasMany(ProposalStatus::class);
    }

    public function academicCalendar()
    {
        return $this->belongsTo(AcademicCalendar::class);
    }
}
