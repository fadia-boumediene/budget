<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SousOperation extends Model
{
    use HasFactory;
    protected $table = 'sous_operations';
    protected $primaryKey = 'code_sous_operation';
    public $incrementing = false;
    protected $keyType = 'integer';
    public $timestamps = false;

    protected $fillable = [
       'code_sous_operation','nom_sous_operation','nom_sous_operation_ar','AE_sous_operation','CP_sous_operation','code_t1','code_t2','code_t3','code_t4'
,'AE_ouvert','AE_atendu','CP_ouvert','CP_atendu','code_operation','AE_engage','CP_reporte','AE_reporte','AE_notifie','CP_notifie','CP_consome',
'date_insert_SOUSoperation','date_update_SOUSoperation'
 ];


    public function Operation()
    {
        return $this->belongsTo(Operation::class,'code_operation','code_operation');
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

    public function SousOperation()
    {
        return $this->hasMany(ConstruireDPIA::class,'code_sous_operation','code_sous_operation');
    }


}
