<?php

namespace App\Models;

use App\Models\T1;
use App\Models\T2;
use App\Models\T3;
use App\Models\T4;
use App\Models\SousProgramme;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class initPort extends Model
{
    use HasFactory;
    protected $table = 'init_ports';
    protected $primaryKey = 'id_init';
    public $incrementing = true;
    protected $keyType = 'integer';
    public $timestamps = false;

    protected $fillable = [
       'id_init','date_init','AE_init_t1','CP_init_t1','AE_init_t2'
        ,'CP_init_t2','AE_init_t3','CP_init_t3','AE_init_t4','CP_init_t4','AE_init_t3_NONREPARTIS','CP_init_t3_NONREPARTIS','AE_init_t4_NONREPARTIS',
        'code_t1','code_t2','code_t3','code_t4', 'num_sous_prog','CP_init_t2_NONREPARTIS','AE_init_t2_NONREPARTIS','CP_init_t4_NONREPARTIS',
        'AE_init_t1_NONREPARTIS', 'CP_init_t1_NONREPARTIS','date_update_init'

    ];
  
    public function sousProgramme()
    {
        return $this->belongsTo(SousProgramme::class,'num_sous_prog','num_sous_prog');
    }

    public function T1()
    {
        return $this->belongsTo(T1::class,'code_t1','code_t1');
    }

    public function T2()
    {
        return $this->belongsTo(T2::class,'code_t2','code_t2');
    }

    public function T3()
    {
        return $this->belongsTo(T3::class,'code_t3','code_t3');
    }
    public function T4()
    {
        return $this->belongsTo(T4::class,'code_t4','code_t4');
    }


}
