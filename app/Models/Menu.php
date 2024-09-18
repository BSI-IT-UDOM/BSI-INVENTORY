<?php

namespace App\Models;

use App\Models\invMenuCate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory;
    protected $table = 'inv_menu';
    public $timestamps = false;
    protected $primaryKey = 'Menu_id';
    public $incrementing = true;
    protected $keyType = 'int'; 
    protected $fillable = [
        'Menu_name_eng',
        'Menu_name_kh',
        'Menu_Cate_id',
        'image',
        'status'
    ];
    public function menuCategory()
    {
        return $this->belongsTo(invMenuCate::class, 'Menu_Cate_id', 'Menu_Cate_id');
    }
}
