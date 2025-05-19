<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    protected $fillable = [
        'name',
        'nidn',
    ];

    public function students1()
    {
        return $this->hasMany(Student::class, 'lecture_1_id');
    }

    public function students2()
    {
        return $this->hasMany(Student::class, 'lecture_2_id');
    }
}
