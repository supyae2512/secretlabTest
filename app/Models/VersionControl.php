<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VersionControl extends Model
{
    use HasFactory;

    protected $table = 'version_control';

    public $timestamps = false;

    protected $fillable = [
        'v_key',
        'v_value',
        'created_at',
    ];

    protected $casts = [
        'v_key' => 'string',
        'v_value' => 'string',
        'created_at' => 'datetime'
    ];
}
