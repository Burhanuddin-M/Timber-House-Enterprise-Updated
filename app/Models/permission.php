<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class permission extends Model
{
    use HasFactory;

    public $table = 'permissions';

    protected $casts = [
        'permissions' => 'array',
    ];

    public function credential()
    {
        return $this->belongsTo(credentials::class, 'credential_id');
    }
}
