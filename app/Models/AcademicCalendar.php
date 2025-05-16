<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class AcademicCalendar extends Model
{
    protected $fillable = [
        'started_date',
        'ended_date',
    ];

    protected $casts = [
        'started_date' => 'date',
        'ended_date' => 'date',
    ];

    public function getRawStartedDateAttribute()
    {
        return $this->attributes['started_date'];
    }

    public function getRawEndedDateAttribute()
    {
        return $this->attributes['ended_date'];
    }

    public function getStartedDateYearAttribute()
    {
        return Carbon::parse($this->getRawStartedDateAttribute())->format('Y');
    }

    public function getEndedDateYearAttribute()
    {
        return Carbon::parse($this->getRawEndedDateAttribute())->format('Y');
    }

    public function getPeriodeYearAttribute()
    {
        return $this->started_date_year . '-' . $this->ended_date_year;
    }

    public function proposals()
    {
        return $this->hasMany(Proposal::class);
    }
}
