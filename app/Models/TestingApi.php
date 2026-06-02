<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestingApi extends Model
{

    use HasFactory;

    protected $table = 'testing';

    protected $fillable = [
        'code',
        'name',
        'description',
        'status',
    ];
}
