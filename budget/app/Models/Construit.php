<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Construit extends Model
{
    use HasFactory;
    protected $table = 'construits';
    protected $primaryKey = 'id_construit';
    public $incrementing = false; 
    protected $keyType = 'integer'; 
    public $timestamps = false;

    protected $fillable = [
       'id_construit','id_extrait','id_rff','num_action'
 ];
   
 
    public function RFF()
    {
        return $this->belongsTo(RFF::class,'id_rff','id_rff');
    }

    public function Action()
    {
        return $this->belongsTo(Action::class,'num_action','num_action');
    }

    public function Extrait_DPIC()
    {
        return $this->belongsTo(Extrait_DPIC::class,'id_extrait','id_extrait');
    }
}