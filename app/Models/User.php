<?php

namespace App\Models;

use App\Models\InvRole;
use App\Models\InvLocation;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'inv_user';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'U_id'; // Specify your primary key column name

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public $timestamps = false;
    protected $fillable = [
        'U_name',
        'U_id',
        'U_photo',
        'password',
        'U_contact',
        'sys_name',
        'S_id',
        'status',
        'R_id',
        'L_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the invshop that owns the user.
     */
    public function invshop()
    {
        return $this->belongsTo(Invshop::class, 'S_id', 'S_id');
    }
    public function InvRole()
    {
        return $this->belongsTo(InvRole::class, 'R_id', 'R_id');
    }
    public function invLocation()
    {
        return $this->belongsTo(InvLocation::class, 'L_id', 'L_id');
    }
    public function invOwner()
    {
        return $this->belongsTo(InvOwner::class);
    }
}
