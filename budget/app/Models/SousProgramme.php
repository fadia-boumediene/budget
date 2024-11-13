<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class SousProgramme extends Model
{
    use HasFactory;
    protected $table = 'sous_programmes';
    protected $primaryKey = 'num_sous_prog';
    public $incrementing = false;
    protected $keyType = 'integer';
    public $timestamps = false;

    protected $fillable = [
      'num_sous_prog','nom_sous_prog','nom_sous_prog_ar','AE_sous_prog','CP_sous_prog'
,'date_insert_sousProg','date_update_sousProg','num_prog'
];


    public function Programme()
    {
        return $this->belongsTo(Programme::class,'num_prog','num_prog');
    }

    public function Action()
    {
        return $this->hasMany(Action::class,'num_sous_prog','num_sous_prog');
    }

    public function multimedias()
    {
        return $this->morphMany(Multimedia::class, 'related');
    }
}
