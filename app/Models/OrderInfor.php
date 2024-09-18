<?php

namespace App\Models;

use App\Models\Orders;
use App\Models\Currency;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderInfor extends Model
{
    use HasFactory;
    protected $table = 'order_info';
    public $timestamps = false;
    protected $primaryKey = 'Order_Info_id';
    public $incrementing = true;
    protected $keyType = 'int'; 
    protected $fillable = [
        'Order_number',
        'Reciept_image',
        'Total_Price',
        'inc_VAT',
        'S_id',
        'L_id',
        'Sup_id',
        'inc_VAT',
        'order_date',
        'Currency_id'     

    ];
        // Define the one-to-many relationship
        public function Orders()
        {
            return $this->hasMany(InvLocation::class, 'Order_Info_id', 'Order_Info_id');       
        }
        public function currency()
        {
            return $this->belongsTo(Currency::class, 'Currency_id', 'Currency_id');
        }
}
