<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Saldo;
use Illuminate\Notifications\Notifiable;
// use App\Models\CekPlagiarismeTransaction;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'balance',
        'role_id',
        'quota',
        'google_id',
        'google_token',
        'google_refresh_token',
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

    // public function balance(): HasOne
    // {
    //     return $this->hasOne(UserBalance::class);
    // }

    public function saldos()
    {
        return $this->hasMany(Saldo::class);
    }
    // public function cekPlagiarismeTransactions()
    // {
    //     return $this->hasMany(CekPlagiarismeTransaction::class);
    // }

    public function documents()
    {
        return $this->hasMany(Document::class); // Relasi ke Document
    }
}
