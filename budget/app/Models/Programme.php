<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programme extends Model
{
    use HasFactory;
    protected $table = 'programmes';
    protected $primaryKey = 'num_prog';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
       'num_prog','nom_prog','nom_prog_ar','date_update_portef','AE_prog','CP_prog'
,'id_rp','num_portefeuil','date_insert_portef','AE_prog_NONREPARTIS','CP_prog_NONREPARTIS'
 ];


    public function Respo_Prog()
    {
        return $this->belongsTo(Respo_Prog::class,'id_rp','id_rp');
    }

    public function Portefeuille()
    {
        return $this->belongsTo(Portefeuille::class,'num_portefeuil','num_portefeuil');
    }

    public function SousProgramme()
    {
        return $this->hasMany(SousProgramme::class ,'num_prog','num_prog');
    }

    public function ModificationT()
    {
        return $this->hasMany(ModificationT::class ,'num_prog','num_prog');
    }

    public function multimedias()
    {
        return $this->morphMany(Multimedia::class, 'related');
    }
}
