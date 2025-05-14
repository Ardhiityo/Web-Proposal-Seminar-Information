<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function proposals1()
    {
        return $this->hasMany(Proposal::class, 'lecture_1_id');
    }

    public function proposals2()
    {
        return $this->hasMany(Proposal::class, 'lecture_2_id');
    }
}
