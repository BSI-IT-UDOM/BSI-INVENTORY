<?php

namespace App\Models;

use App\Models\Material;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MaterialCategory extends Model
{
    use HasFactory;
    protected $table = 'inv_material_cate';
    public $timestamps = false;
    protected $primaryKey = 'Material_Cate_id';
    public $incrementing = true;
    protected $keyType = 'int'; 
    protected $fillable = [
        'Material_Cate_Khname',
        'Material_Cate_Engname',
        'Material_Cate_type',
        'status'
    ];
    public function material()
    {
        return $this->hasMany(Material::class, 'Material_Cate_id', 'Material_Cate_id');
    }
}
