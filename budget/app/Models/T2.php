<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class T2 extends Model
{
    use HasFactory;
    protected $table = 't2_s';
    protected $primaryKey = 'code_t2';
    public $incrementing = false; 
    protected $keyType = 'integer'; 
    public $timestamps = false;

    protected $fillable = [
       'code_t2','nom_t2','nom_t2_ar' 
    ];
    
    public function SousOperation()
    {
        return $this->hasMany(SousOperation::class,'code_t2');
 
    }

    public function initPorts()
    {
        return $this->hasMany(initPort::class,'code_t2');
    }
}
