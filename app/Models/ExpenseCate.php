<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseCate extends Model
{
    use HasFactory;
    protected $table = 'inv_expense_cate';
    public $timestamps = false;
    protected $primaryKey = 'IEC_id';
    public $incrementing = true;
    protected $keyType = 'int'; 
    protected $fillable = [
        'IEC_Khname',
        'IEC_Engname',
        'status'
    ];
}
