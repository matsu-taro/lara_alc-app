<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alcohol;
use App\Models\Image;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AlcoholController extends Controller
{
  public function index()
  {
    $alcohols = Alcohol::where('user_id', Auth::id())->orderBy('updated_at', 'desc')->paginate(10);
    $alcoholIds = Alcohol::where('user_id', Auth::id())->pluck('id')->toArray();
    $images = Image::whereIn('alcohol_id', $alcoholIds)->get();

    return view('alcohols.index', compact('alcohols', 'images'));
  }

  public function create()
  {
    $alcohols = Alcohol::where('user_id', Auth::id())->get();
    $places = $alcohols->unique('place');
    return view('alcohols.create', compact('places'));
  }

  public function store(Request $request)
  {
    $newPlace = $request->new_place;
    $selectedPlace = $request->place;

    if ($newPlace) {
      $alcohol = Alcohol::create([
        'user_id' => Auth::id(),
        'alc_name' => $request->alc_name,
        'price' => $request->price,
        'place' => $newPlace,
        'status' => $request->status,
        'type' => $request->type,
        'memo' => $request->memo,
      ]);
    } elseif ($selectedPlace) {
      $alcohol = Alcohol::create([
        'user_id' => Auth::id(),
        'alc_name' => $request->alc_name,
        'price' => $request->price,
        'place' => $selectedPlace,
        'status' => $request->status,
        'type' => $request->type,
        'memo' => $request->memo,
      ]);
    }

    if ($request->hasFile('files')) {
      $files = $request->file('files');

      foreach ($files as $file) {
        $randFileName = uniqid();
        $extension = $file->getClientOriginalExtension(); //拡張子を抽出
        $originalFileName = $randFileName . '.' . $extension;

        $path = $file->storeAs('public/' . $originalFileName);

        Image::create([
          'alcohol_id' => $alcohol->id,
          'original_file_name' => $originalFileName,
          'path' => $path,
        ]);
      };
    };

    return to_route('alcohols.index');
  }


  public function show(string $id)
  {
    //
  }


  public function edit(string $id)
  {
    $places = Alcohol::all()->unique('place');
    $alcohol = Alcohol::findOrFail($id);

    $alcoholIds = Alcohol::where('user_id', Auth::id())->pluck('id')->toArray();
    $images = Image::whereIn('alcohol_id', $alcoholIds)->get();

    return view('alcohols.edit', compact('places', 'alcohol', 'images'));
  }


  public function update(Request $request, string $id)
  {
    $update_data = Alcohol::find($id);

    $update_data->user_id = Auth::id();
    $update_data->alc_name = $request->alc_name;
    $update_data->price = $request->price;
    $update_data->place = $request->place;
    $update_data->type = $request->type;
    $update_data->status = $request->status;
    $update_data->memo = $request->memo;

    $update_data->save();

    return to_route('alcohols.index');
  }


  public function destroy(string $id)
  {
    Alcohol::findOrFail($id)
      ->delete();

    return to_route('alcohols.index');
  }

  public function dustBox()
  {
    $deleted_datas = Alcohol::onlyTrashed()->paginate(10);
    $alcoholIds = Alcohol::onlyTrashed()->where('user_id', Auth::id())->pluck('id')->toArray();
    $images = Image::whereIn('alcohol_id', $alcoholIds)->get();

    return view('alcohols.dust-box', compact('deleted_datas', 'images'));
  }

  public function restore($id)
  {
    $onlyTrashed = Alcohol::onlyTrashed()->find($id);
    $onlyTrashed->restore();

    return to_route('alcohols.dust-box');
  }

  public function dustBoxClear(string $id)
  {
    $alcohol = Alcohol::onlyTrashed()->findOrFail($id);
    $paths = $alcohol->images()->pluck('path');

    foreach ($paths as $path) {
      if (Storage::exists($path)) {
        Storage::delete($path);
      }
    }

    Alcohol::onlyTrashed()->findOrFail($id)->forceDelete();

    return to_route('alcohols.dust-box');
  }
}
