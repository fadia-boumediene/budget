<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personne extends Model
{
    use HasFactory;

    protected $table = 'personnes';
    protected $primaryKey = 'id_nin';
    public $incrementing = false; 
    protected $keyType = 'integer'; 
    public $timestamps = false;

    protected $fillable = [
       'id_nin','NSS','Nom_per','Prenom_per','Nom_ar_per','Prenom_ar_per','Date_nais',
       'Lieu_nais','Lieu_nais_ar','adress','adress_ar','num_tlf','mail_pro'
    ];
   
    public function Ministre()
    {
        return $this->hasOne(Ministre::class,'id_nin','id_nin');
    }

    public function Respo_Prog()
    {
          return $this->hasOne(Respo_Prog::class,'id_nin','id_nin');
    }
    public function Respo_Action()
    {
          return $this->hasOne(Respo_Action::class,'id_nin','id_nin');
    }
    public function RFF()
    {
          return $this->hasOne(RFF::class,'id_nin','id_nin');
    }


}

