<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'title',
        'body',
        'created_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public static function boot()
    {
        parent::boot();
        date_default_timezone_set("Asia/Jakarta");
        self::creating(function ($model) {
            $model->created_at = date("Y-m-d H:i:s");
        });

        self::updating(function ($model) {
            $model->updated_at = date("Y-m-d H:i:s");
        });
    }
}
