<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Image;

class Alcohol extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'alc_name',
        'price',
        'place',
        'status',
        'type',
        'memo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
