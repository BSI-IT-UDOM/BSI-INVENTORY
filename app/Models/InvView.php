<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvView extends Model
{
    use HasFactory;
    protected $table = 'inventory_view';
    public $timestamps = false;
    protected $fillable = [
        'S_id',
        'L_id',
        'Item_Name',
        'Category',
        'Total_StockIn',
        'Total_In_Hand',
        'UOM',
        'Expired_Date'
    ];
}
