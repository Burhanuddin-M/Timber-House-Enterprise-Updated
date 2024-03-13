<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sagientry extends Model
{
    use HasFactory;

    protected $table = "sagientry";

    // protected $fillable = [ 
    //     'desc',
    //     'price',  
    //     'column_2_id',
    // ];

    public function sagi()
    {
        return $this->belongsTo(sagi::class, 'sagi_id', 'id');
    }
}
