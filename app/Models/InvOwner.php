<?php

namespace App\Models;

use App\Models\Invshop;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvOwner extends Model
{
    use HasFactory;

    protected $table = 'inv_owner';
    public $timestamps = false;
    protected $primaryKey = 'O_id';
    public $incrementing = true;
    protected $keyType = 'int'; 
    protected $fillable = [
        'O_name',
        'O_contact',
        'O_email',
        'O_address',
        'status'
    ];
    public function invShop()
    {
        return $this->hasMany(Invshop::class);
    }
}
