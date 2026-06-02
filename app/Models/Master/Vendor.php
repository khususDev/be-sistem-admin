<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendor extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'mst_vendors';

    protected $fillable = [
        'code_vendor',
        'nama_vendor',
        'penanggung_jawab',
        'email',
        'telepon',
        'alamat',
        'status'
    ];

    // Mengonversi tipe data bawaan jika diperlukan
    protected $casts = [
        'status' => 'string',
    ];
}
