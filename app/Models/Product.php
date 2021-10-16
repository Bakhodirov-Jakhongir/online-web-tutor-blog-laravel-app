<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function generateUniqueCode()
    {
        do {
            $code = random_int(100000, 999999);
        } while (Product::where("root_id", "=", $code)->first());

        return $code;
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->root_id = Product::generateUniqueCode();
        });
    }
}
