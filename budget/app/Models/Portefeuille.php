<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portefeuille extends Model
{
    use HasFactory;
    protected $table = 'portefeuilles';
    protected $primaryKey = 'num_portefeuil';
    public $incrementing = false;
    protected $keyType = 'integer';
    public $timestamps = false;

    protected $fillable = [
       'num_portefeuil','Date_portefeuille','nom_journal','num_journal'
   ,'AE_portef','CP_portef','id_min'
 ];

    public function Ministre()
    {
        return $this->belongsTo(Ministre::class,'id_min','id_min');
    }

    public function Programme()
    {
        return $this->hasMany(Programme::class,'num_portefeuil','num_portefeuil');
    }

    public function multimedias()
    {
        return $this->morphMany(Multimedia::class, 'related');
    }
}
