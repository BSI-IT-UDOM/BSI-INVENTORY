<?php

namespace App\Models;

use App\Models\InHand;
use App\Models\MaterialCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Material extends Model
{
    use HasFactory;
    protected $table = 'inv_material';
    public $timestamps = false;
    protected $primaryKey = 'Material_id';
    public $incrementing = true;
    protected $keyType = 'int'; 
    protected $fillable = [
        'Material_Khname',
        'Material_Engname',
        'Material_Cate_id',
        'Expiry_date',
        'image',
        'status'
    ];
    public function materialCategory()
    {
        return $this->belongsTo(MaterialCategory::class, 'Material_Cate_id', 'Material_Cate_id');
    }
    public function inhand()
    {
        return $this->belongsTo(InHand::class, 'Material_id', 'Material_id');
    }
}
