<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ministre extends Model
{
    use HasFactory;
    protected $table = 'ministres';
    protected $primaryKey = 'id_min';
    public $incrementing = false; 
    protected $keyType = 'integer'; 
    public $timestamps = false;

    protected $fillable = [
       'id_min','Date_installation','id_nin' 
    ];
   
    public function Personne()
    {
        return $this->belongsTo(Personne::class,'id_nin','id_nin');
    }
    public function Portefeuille()
    {
        return $this->hasOne(Portefeuille::class,'id_min','id_min');
    }

 

}
