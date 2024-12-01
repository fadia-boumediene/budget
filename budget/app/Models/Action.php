<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    use HasFactory;
    protected $table = 'actions';
    protected $primaryKey = 'num_action';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
       'num_action','nom_action','nom_action_ar','date_insert_action','AE_action','CP_action','date_update_action','id_ra','num_sous_prog'
 ];


    public function Respo_Action()
    {
        return $this->belongsTo(Respo_Action::class,'id_rp','id_rp');
    }

    public function SousProgramme()
    {
        return $this->belongsTo(SousProgramme::class,'num_sous_prog','num_sous_prog');
    }

    public function SousAction()
    {
        return $this->hasMany(SousAction::class,'num_action','num_action');
    }
    public function Construit()
    {
        return $this->hasMany(Construit::class,'num_action','num_action');
    }

    public function multimedias()
    {
        return $this->morphMany(Multimedia::class, 'related');
    }
}
