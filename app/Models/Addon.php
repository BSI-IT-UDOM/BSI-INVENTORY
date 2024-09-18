<?php

namespace App\Models;

use App\Models\UOM;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Addon extends Model
{
    use HasFactory;
    protected $table = 'inv_addons';
    public $timestamps = false;
    protected $primaryKey = 'Addons_id';
    public $incrementing = true;
    protected $keyType = 'int'; 
    protected $fillable = [
        'Addons_name',
        'Percentage',
        'Qty',
        'UOM_id',
        'status'
    ];
    public function uom()
    {
        return $this->belongsTo(UOM::class, 'UOM_id', 'UOM_id');
    }
}
