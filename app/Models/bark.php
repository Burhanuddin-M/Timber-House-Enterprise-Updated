<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bark extends Model
{
    use HasFactory;

    protected $table = "bark";

    protected $fillable = [ 
        'name',
        'long_rate',
        'short_rate',
    ];

    public function barkentry(){
        return $this->hasMany(barkentry::class,'bark_id','id');
    }
}
