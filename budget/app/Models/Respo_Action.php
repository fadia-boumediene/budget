<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Respo_Action extends Model
{
    use HasFactory;
    protected $table = 'respo__actions';
    protected $primaryKey = 'id_ra';
    public $incrementing = false; 
    protected $keyType = 'integer'; 
    public $timestamps = false;

    protected $fillable = [
       'id_ra','Date_installation_ra','id_nin' 
    ];
   
    public function Personne()
    {
        return $this->belongsTo(Personne::class,'id_nin','id_nin');
    }

    public function Action()
    {
        return $this->hasOne(Action::class,'id_ra','id_ra');
    }
    
    public function Realiser()
    {
        return $this->hasMany(Realiser::class,'id_ra','id_ra');
    }

    public function ConstruireDPIA()
    {
        return $this->hasMany(ConstruireDPIA::class,'id_ra','id_ra');
    }

    
}

