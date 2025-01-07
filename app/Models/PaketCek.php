<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaketCek extends Model
{
    protected $fillable = ['nama_paket', 'harga', 'jumlah_cek'];
}
