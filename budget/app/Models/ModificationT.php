<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModificationT extends Model
{
    use HasFactory;
    protected $table = 'modification_t_s';
    protected $primaryKey = 'id_modif';
    public $incrementing = true;
    protected $keyType = 'integer';
    public $timestamps = false;

    protected $fillable = [
       'id_modif','date_modif','AE_envoi_t1','CP_envoi_t1','AE_envoi_t2'
,'CP_envoi_t2','AE_envoi_t3','CP_envoi_t3','AE_envoi_t4','CP_envoi_t4',
'code_t1','code_t2','code_t3','code_t4','id_art','AE_recoit_t1','CP_recoit_t1'
,'AE_recoit_t2','num_prog', 'situation_modif','type_modif','CP_recoit_t2','AE_recoit_t3','CP_recoit_t3','AE_recoit_t4','CP_recoit_t4','num_sous_prog_click','num_prog_click','num_sous_prog_retire','num_prog_retire'
 ,'action_modifie', 'code_t1', 'code_t2','code_t3','code_t4'];


    public function articles()
    {
        return $this->belongsTo(Article::class,'id_art','id_art');
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


    public function SousProgramme()
    {
        return $this->belongsTo(SousProgramme::class,'num_sous_prog','num_sous_prog');
    }

    public function Programme()
    {
        return $this->belongsTo(Programme::class,'num_prog','num_prog');
    }
}
