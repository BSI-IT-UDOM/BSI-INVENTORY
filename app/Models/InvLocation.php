<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvLocation extends Model
{
    use HasFactory;
    protected $table = 'inv_location';
    public $timestamps = false;
    protected $primaryKey = 'L_id';
    public $incrementing = true;
    protected $keyType = 'int'; 
    protected $fillable = [
        'S_id',
        'L_name',
        'L_address',
        'L_contact',
        'status'
    ];
    public function shop()
    {
        return $this->belongsTo(InvShop::class, 'S_id', 'S_id');
    }
}
