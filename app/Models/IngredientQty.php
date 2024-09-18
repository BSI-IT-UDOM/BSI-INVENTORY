<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngredientQty extends Model
{
    use HasFactory;
    protected $table = 'inv_ingredient_qty';
    public $timestamps = false;
    protected $primaryKey = 'IIQ_id';
    public $incrementing = true;
    protected $keyType = 'int'; 
    protected $fillable = [
        'IIQ_name',
        'Material_id',
        'Qty',
        'UOM_id',
        'UOM_id',
        'status'
    ];
}
