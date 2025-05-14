<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
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
}
