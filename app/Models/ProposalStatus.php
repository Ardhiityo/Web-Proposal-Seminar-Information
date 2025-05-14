<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProposalStatus extends Model
{
    public function proposals()
    {
        return $this->belongsTo(Proposal::class);
    }
}
