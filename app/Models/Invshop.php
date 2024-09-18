<?php

namespace App\Models;

use App\Models\User;
use App\Models\InvOwner;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invshop extends Model
{
    use HasFactory;

    protected $table = 'inv_shop';
    public $timestamps = false;
    protected $primaryKey = 'S_id';
    public $incrementing = true;
    protected $keyType = 'int'; 
    protected $fillable = [
        'S_name',
        'S_logo',
        'O_id',
        'status',
    ];
    public function InvOwner()
    {
        return $this->belongsTo(InvOwner::class);
    }
    public function User()
    {
        return $this->hasMany(User::class);
    }
    public function locations()
    {
        return $this->hasMany(InvLocation::class, 'S_id', 'S_id');
    }
}
