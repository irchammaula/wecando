<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CBTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'trxid_api',
        'code',
        'phone',
        'idcust',
        'sequence',
        'status',
        'sn',
        'note',
        'price',
        'date_insert',
        'date_update',
        'last_balance',
    ];

    // Definisikan relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
