<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name',
        'nim',
        'lecture_1_id',
        'lecture_2_id',
    ];

    public function proposals()
    {
        return $this->hasMany(Proposal::class);
    }

    public function lecture1()
    {
        return $this->belongsTo(Lecture::class, 'lecture_1_id');
    }

    public function lecture2()
    {
        return $this->belongsTo(Lecture::class, 'lecture_2_id');
    }
}
