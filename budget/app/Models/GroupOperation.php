<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupOperation extends Model
{
    use HasFactory;
    protected $table = 'group_operations';
    protected $primaryKey = 'code_grp_operation';
    public $incrementing = false; 
    protected $keyType = 'string'; 
    public $timestamps = false;

    protected $fillable = [
       'code_grp_operation','nom_grp_operation','nom_grp_operation_ar'
,'date_insert_grp_operation','date_update_grp_operation','num_sous_action'
 ];
   
 
    public function sousAction()
    {
        return $this->belongsTo(sousAction::class,'num_sous_action','num_sous_action');
    }

    public function Operation()
    {
        return $this->hasMany(Operation::class,'code_grp_operation','code_grp_operation');
    }

}