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
  }


  public function destroy($id)
  {
    $image = Image::findOrFail($id);

    if (Storage::exists($image->path)) {
      Storage::delete($image->path);
    }

    Image::findOrFail($id)
      ->delete();

    return back();
  }
}
