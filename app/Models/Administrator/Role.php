<?php

namespace App\Models\Administrator;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    protected $fillable = [
        'code',
        'name',
        'description',
        'is_active'
    ];
}
