<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    const PERMISSIONS = [
        'HF',
        'PL',
        'VC',
        'RE',
        'PC',
    ];

    protected $fillable = [
        'name',
        'permission',
        'description',
    ];

    protected $casts = [
        'permission' => 'json',
    ];
}
