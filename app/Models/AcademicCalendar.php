<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicCalendar extends Model
{
    protected $fillable = [
        'started_date',
        'ended_date',
    ];

    public function proposals()
    {
        return $this->hasMany(Proposal::class);
    }
}
