<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Alcohol;

class Image extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'alcohol_id',
        'original_file_name',
        'path',
    ];

    public function alcohols()
    {
        return $this->belongsTo(Alcohol::class, 'alcohol_id');
    }
}
