<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class credentials extends Model
{
    use HasFactory;

    public function permission()
{
    return $this->hasOne(Permission::class, 'credential_id'); // Use 'credential_id' as the foreign key
}
}
