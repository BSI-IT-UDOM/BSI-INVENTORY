<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    protected $table = 'inv_expenses';
    public $timestamps = false;
    protected $primaryKey = 'Exp_id';
    public $incrementing = true;
    protected $keyType = 'int'; 
    protected $fillable = [
        'Exp_name',
        'IEC_id',
        'references_doc',
        'Exp_date',
        'status'
    ];
    public function expenseCategory()
    {
        return $this->belongsTo(ExpenseCate::class, 'IEC_id', 'IEC_id');
    }
}
