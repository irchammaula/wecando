<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortLink extends Model
{
    use HasFactory;

    protected $fillable = ['original_url', 'shortened_url'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
