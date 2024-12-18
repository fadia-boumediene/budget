<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $table = 'articles';
    protected $primaryKey = 'id_art';
    public $incrementing = true; 
    protected $keyType = 'integer'; 
    public $timestamps = false;

    protected $fillable = [
       'id_art','nom_art','nom_art_ar','description_art','code_art','description_art_ar'
        
 ];

 public function ModificationT()
    {
        return $this->hasMany(ModificationT::class,'id_art','id_art');
    }

 

}
