<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personal_access_tokens extends Model
{
    use HasFactory;

    protected $fillable = [        
        'token',
        'last_used_at',
        'expires_at',
    ];
}
