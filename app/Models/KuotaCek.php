<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KuotaCek extends Model
{
    protected $fillable = ['user_id', 'jumlah_cek', 'status'];
}
