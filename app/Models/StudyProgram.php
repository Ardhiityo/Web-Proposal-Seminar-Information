<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudyProgram extends Model
{
    public function students()
    {
        return $this->hasOne(Student::class);
    }
}
