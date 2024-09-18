<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $table = 'view_sale_detail';
    public $timestamps = false;
    protected $primaryKey = 'ID';
    public $incrementing = true;
    protected $keyType = 'int'; 
    protected $fillable = [
        'Shop_Name',
        'Location',
        'Product_Name',
        'Addon',
        'Qty',
        'Price',
        'Currency',
        'Sale_date'
    ];
}

