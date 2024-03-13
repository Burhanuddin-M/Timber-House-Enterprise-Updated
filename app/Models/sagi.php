<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sagi extends Model
{
    use HasFactory;

    protected $table = "sagi";

    protected $fillable = [ 
        'party_name',
    ];

    public function sagientry(){
        return $this->hasMany(sagientry::class,'sagi_id','id');
    }
}
