<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;


class Agent extends Model
{   
    use HasFactory;
  use SoftDeletes;
    
    protected $keyType = 'uuid';
 
 protected $fillable = [
        
        'name',
        'code_name',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];
    
  protected static function boot()
    {
        parent::boot();

      
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });

        }
}
