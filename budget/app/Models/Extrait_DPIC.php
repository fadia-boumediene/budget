<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extrait_DPIC extends Model
{
    use HasFactory;
    protected $table = 'extrait__d_p_i_c_s';
    protected $primaryKey = 'id_extrait';
    public $incrementing = false; 
    protected $keyType = 'integer'; 
    public $timestamps = false;

    protected $fillable = [
       'id_extrait','Date_extrait','delai'
 ];

 public function Realiser()
 {
     return $this->hasMany(Realiser::class,'id_extrait','id_extrait');
 }
 public function Construit()
 {
     return $this->hasMany(Construit::class,'id_extrait','id_extrait');
 }
}
