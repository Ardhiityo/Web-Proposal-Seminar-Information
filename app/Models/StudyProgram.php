<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudyProgram extends Model
{

    protected $fillable = [
        'name',
    ];

    public function students()
    {
        return $this->hasOne(Student::class);
    }
}
