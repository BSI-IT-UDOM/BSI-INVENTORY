<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvRole extends Model
{
    use HasFactory;
    protected $table = 'inv_role';
    public $timestamps = false;
    protected $primaryKey = 'R_id';
    public $incrementing = true;
    protected $keyType = 'int'; 
    protected $fillable = [
        'S_id',
        'R_type',
        'status'
    ];
}
