<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $table = 'inv_sales';
    public $timestamps = false;
    protected $primaryKey = 'Sale_id';
    public $incrementing = true;
    protected $keyType = 'int'; 
    protected $fillable = [
        'S_id',
        'L_id',
        'Menu_name_eng',
        'Menu_name_kh',
        'addons',
        'Qty',
        'price',
        'Currency_id',
        'Sale_date',
    ];
}
