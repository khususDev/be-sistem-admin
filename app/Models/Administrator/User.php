<?php

namespace App\Models\Administrator;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Administrator\Role;
use Laravel\Sanctum\HasApiTokens;
// Ganti 'spatie' menjadi 'Spatie' (Huruf S besar)
use Spatie\Permission\Traits\HasRoles;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasApiTokens, HasRoles, LogsActivity, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'role_id',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function role()
    {
        // Ganti tujuan relasinya ke model Role milik Spatie
        return $this->belongsTo(\Spatie\Permission\Models\Role::class, 'role_id');
    }



    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable() // Otomatis mencatat semua perubahan pada kolom $fillable
            ->logOnlyDirty() // Hanya mencatat kolom yang benar-benar diubah nilainya
            ->dontSubmitEmptyLogs(); // Jangan catat kalau tidak ada yang berubah
    }
}
