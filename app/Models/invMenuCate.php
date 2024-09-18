<?php

namespace App\Models;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class invMenuCate extends Model
{
    use HasFactory;
    protected $table = 'inv_menu_cate';
    public $timestamps = false;
    protected $primaryKey = 'Menu_Cate_id';
    public $incrementing = true;
    protected $keyType = 'int'; 
    protected $fillable = [
        'Cate_Khname',
        'Cate_Engname',
        'MenuGR_id',
        'status'
    ];
    public function menu()
    {
        return $this->hasMany(Menu::class, 'Menu_Cate_id', 'Menu_Cate_id');
    }
}
