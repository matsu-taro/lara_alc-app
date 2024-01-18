<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Image;
use Requests;

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

  public function scopeSerch($query, $serch)
  {
    if ($serch !== null) {
      $serch_split = mb_convert_kana($serch, 's');
      $serch_split2 = preg_split('/[\s]+/', $serch_split);
      foreach ($serch_split2 as $value) {
        $query->orWhere('alc_name', 'like', '%' . $value . '%');
        $query->orWhere('memo', 'like', '%' . $value . '%');
      }
    }

    return $query;
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function images()
  {
    return $this->hasMany(Image::class);
  }
}
