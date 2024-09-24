<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Realiser extends Model
{
    use HasFactory;
    protected $table = 'realisers';
    protected $primaryKey = 'id_realiser';
    public $incrementing = false; 
    protected $keyType = 'integer'; 
    public $timestamps = false;

    protected $fillable = [
       'id_realiser','Date_realiser','AE_old_realiser','CP_old_realiser'
,'AE_nv_realiser','CP_nv_realiser','id_ra','id_extrait'];
   
 
    public function Extrait_DPIC()
    {
        return $this->belongsTo(Extrait_DPIC::class,'id_extrait','id_extrait');
    }

    public function Respo_Action()
    {
        return $this->belongsTo(Respo_Action::class,'id_ra','id_ra');
    }
}