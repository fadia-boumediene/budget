<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
   // Indiquer la table associée si elle n'est pas au pluriel
   protected $table = 'logs';

   // Les colonnes de la table qui peuvent être assignées en masse
   protected $fillable = [
       'action', 'model', 'model_id', 'original', 'changed', 'ip_address', 'id_art'
   ];

   // Indiquer que les données 'original' et 'changed' sont au format JSON
   protected $casts = [
       'original' => 'array',
       'changed' => 'array',
   ];

   // Si vous utilisez les timestamps
   public $timestamps = true;
}
