<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class multimedia extends Model
{
    use HasFactory;
    protected $table = 'multimedia';
    protected $primaryKey = 'id_multi';
    public $incrementing = true;
    protected $keyType = 'integer';
    public $timestamps = true;

    protected $fillable = [
        'id_multi','nom_fichier','filepath',
        'description','size','uploaded_by', 'related_id',
        //'num_portefeuil','num_prog',
        //'num_sous_prog','num_action'
    ];

//un portefeuille a plusieurs fichier
    public function related()
    {
        return $this->morphTo();
    }
}
