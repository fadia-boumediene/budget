<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class T3 extends Model
{
    use HasFactory;
    protected $table = 't3_s';
    protected $primaryKey = 'code_t3';
    public $incrementing = false; 
    protected $keyType = 'integer'; 
    public $timestamps = false;

    protected $fillable = [
       'code_t3','nom_t3','nom_t3_ar' 
    ];
    
    public function SousOperation()
    {
        return $this->hasMany(SousOperation::class,'code_t3');
    }
}
