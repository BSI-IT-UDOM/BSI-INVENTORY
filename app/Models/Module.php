<?php

namespace App\Models;

use App\Models\SysModule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Module extends Model
{
    use HasFactory;
    protected $table = 'auth_module';
    public $timestamps = false;
    protected $primaryKey = 'AM_id';
    public $incrementing = true;
    protected $keyType = 'int'; 
    protected $fillable = [
        'SM_id',
        'R_id',
        'status',
    ];
    public function SysModule()
    {
        return $this->belongsTo(SysModule::class, 'SM_id', 'SM_id');
    }
}
