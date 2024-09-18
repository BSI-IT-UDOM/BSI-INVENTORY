<?php

namespace App\Models;

use App\Models\Invshop;
use App\Models\InvLocation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inventory extends Model
{
    use HasFactory;
    protected $table = 'inventory_view';
    protected $fillable = [
        'S_id',
        'L_id',
        'Material_Name',
        'Category',
        'Total_StockIn',
        'Total_In_Hand',
        'UOM',
        'Expired_Date',

    ];
    public function InvShop()
    {
        return $this->belongsTo(Invshop::class, 'S_id', 'S_id');
    }
    public function Location()
    {
        return $this->belongsTo(InvLocation::class, 'L_id', 'L_id');
    }
}
