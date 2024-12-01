<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class T1 extends Model
{
    use HasFactory;
    protected $table = 't1_s';
    protected $primaryKey = 'code_t1';
    public $incrementing = false; 
    protected $keyType = 'integer'; 
    public $timestamps = false;

    protected $fillable = [
       'code_t1','nom_t1','nom_t1_ar' 
    ];

    public function SousOperation()
    {
        return $this->hasMany(SousOperation::class,'code_t1');
    }
    public function initPorts()
    {
        return $this->hasMany(initPort::class,'code_t1');
    }
}

   