<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Alcohol;

class Image extends Model
{
    use HasFactory;

    public function alcohols()
    {
        return $this->belongsTo(Alcohol::class, 'alcohol_id');
    }
}
