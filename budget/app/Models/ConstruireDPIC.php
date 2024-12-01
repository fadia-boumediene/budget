<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConstruireDPIC extends Model
{
    use HasFactory;
    protected $table = 'construire_d_p_i_c_s';
    protected $primaryKey = 'id_dpic';
    public $incrementing = true; 
    protected $keyType = 'integer'; 
    public $timestamps = false;

    protected $fillable = [
       'id_dpic','date_creation_dpic','AE_dpic_nv','CP_dpic_nv','id_rff','id_rp'

 ];
   
 
    public function RFF()
    {
        return $this->belongsTo(RFF::class,'id_rff','id_rff');
    }



    public function Respo_Prog()
    {
        return $this->belongsTo(Respo_Prog::class,'id_rp','id_rp');
    }
}
