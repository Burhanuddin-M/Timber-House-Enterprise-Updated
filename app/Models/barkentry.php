<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barkentry extends Model
{
    use HasFactory;

    protected $table = "barkentry";

  

    public function bark()
    {
        return $this->belongsTo(bark::class, 'bark_id', 'id');
    }
}
