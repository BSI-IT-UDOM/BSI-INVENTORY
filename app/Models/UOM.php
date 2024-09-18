<?php

namespace App\Models;

use App\Models\Addon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UOM extends Model
{
    use HasFactory;
    protected $table = 'inv_uom';
    public $timestamps = false;
    protected $primaryKey = 'UOM_id';
    public $incrementing = true;
    protected $keyType = 'int'; 
    protected $fillable = [
        'UOM_name',
        'UOM_abb',
        'status'
    ];
    public function addons()
    {
        return $this->hasMany(Addon::class, 'UOM_id', 'UOM_id');
    }
}
