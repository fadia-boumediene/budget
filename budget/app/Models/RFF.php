<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RFF extends Model
{
 
    use HasFactory;
    protected $table = 'r_f_f_s';
    protected $primaryKey = 'id_rff';
    public $incrementing = false; 
    protected $keyType = 'integer'; 
    public $timestamps = false;

    protected $fillable = [
       'id_rff','Date_installation_rff','id_nin' 
    ];
   
    public function Personne()
    {
        return $this->belongsTo(Personne::class,'id_nin','id_nin');
    }

    public function Construit()
    {
        return $this->hasMany(Construit::class,'id_rff','id_rff');
    }

 

}

