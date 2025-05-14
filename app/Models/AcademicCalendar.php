<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicCalendar extends Model
{
    public function proposals()
    {
        return $this->hasMany(Proposal::class);
    }
}
