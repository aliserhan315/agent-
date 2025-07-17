<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agent extends Model
{

    use HasFactory;
    public $incrementing = false;
    protected $keyType = 'uuid';

    protected $fillable = [
        'id',
        'name',
        'code_name',
        'active',
    ];

}
