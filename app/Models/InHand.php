<?php

namespace App\Models;

use App\Models\Items;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InHand extends Model
{
    use HasFactory;
    protected $table = 'inv_in_hand';
    public $timestamps = false;
    protected $primaryKey = 'Hand_id ';
    public $incrementing = true;
    protected $keyType = 'int'; 
    protected $fillable = [
        'S_id',
        'L_id',
        'Material_id ',
        'OldQty',
        'stockInQty',
        'stockOutQty',
        'NewQty',
        'UOM_id '
    ];
    public function material()
    {
        return $this->hasMany(Material::class, 'Material_id', 'Material_id');
    }
}
