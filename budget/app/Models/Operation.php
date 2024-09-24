<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    use HasFactory;
    protected $table = 'operations';
    protected $primaryKey = 'code_operation';
    public $incrementing = false;
    protected $keyType = 'integer';
    public $timestamps = false;

    protected $fillable = [
       'code_operation','nom_operation','nom_operation_ar','date_insert_operation','date_update_operation',
       'code_grp_operation'];


    public function GroupOperation()
    {
        return $this->belongsTo(GroupOperation::class,'code_grp_operation','code_grp_operation');
    }

    public function SousOperation()
    {
        return $this->hasMany(SousOperation::class,'code_operation','code_operation');
    }

}
