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

    public function examiner1()
    {
        return $this->hasMany(Proposal::class, 'examiner_1_id');
    }

    public function examiner2()
    {
        return $this->hasMany(Proposal::class, 'examiner_2_id');
    }

    public function moderator()
    {
        return $this->hasMany(Proposal::class, 'moderator_id');
    }
}
