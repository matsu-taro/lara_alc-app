<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Alcohol;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
  public function index()
  {
    $images = Image::whereHas('alcohols', function ($query) {
      $query->where('user_id', Auth::id());
    })
      ->get()
      ->groupBy(function ($image) {
        return $image->created_at->format('Y年m月');
      });

    return view('alcohols.images', compact('images'));
  }


  public function destroy($id)
  {
    $image = Image::withTrashed()->findOrFail($id);

    if (Storage::exists($image->path)) {
      Storage::delete($image->path);
    }

    $image->forceDelete();

    return back();
  }
}
