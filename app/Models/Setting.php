<?php

namespace App\Models;

use App\Models\InvRole;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model
{
    use HasFactory;
    public function InvRole()
    {
        return $this->belongsTo(InvRole::class, 'R_id', 'R_id');
    }
}

