<?php

namespace App\Models;

use App\Models\OrderInfor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Currency extends Model
{
    use HasFactory;

    protected $table = 'inv_currency';
    public $timestamps = false;
    protected $primaryKey = 'Currency_id';
    public $incrementing = true;
    protected $keyType = 'int'; 
    protected $fillable = [
        'Currency_name',
        'Currency_alias',
        'status'
    ];
    public function OrderInfo()
    {
        return $this->hasMany(OrderInfor::class);
    }
}
