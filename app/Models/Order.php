<?php

namespace App\Models;

use App\Models\UOM;
use App\Models\Currency;
use App\Models\Material;
use App\Models\OrderInfor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    protected $table = 'inv_order';
    public $timestamps = false;
    protected $primaryKey = 'Order_id';
    public $incrementing = true;
    protected $keyType = 'int'; 
    protected $fillable = [
        'Order_Info_id',
        'Material_id',
        'Material_Qty',
        'UOM_id',
        'Order_Qty',
        'price',
        'sub_total',
        'Currency_id'

    ];
     // Define the inverse of the one-to-many relationship
    public function orderInfo()
    {
        return $this->belongsTo(OrderInfor::class, 'Order_Info_id', 'Order_Info_id');
    }

    public function material()
    {
        return $this->belongsTo(Material::class, 'Material_id', 'Material_id');
    }
    public function uom()
    {
        return $this->belongsTo(UOM::class, 'UOM_id', 'UOM_id');
    }
    public function currency()
    {
        return $this->belongsTo(Currency::class, 'Currency_id', 'Currency_id');
    }
}

