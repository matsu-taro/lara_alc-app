<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreRequest;
use App\Models\Alcohol;
use App\Models\Image;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AlcoholController extends Controller
{
  public function index(Request $request)
  {
    $request->flash();

    // 検索対応
    $serch = $request->serch;
    $query = Alcohol::serch($serch);

    // タイプで絞り込み
    if ($request->type) {
      $query->where('type', $request->type);
    }

    // お店で絞り込み
    if ($request->place) {
      $query->where('place', $request->place);
    }

    // 価格で範囲絞り込み
    if ($request->price1 && $request->price2) {
      $query->whereBetween('price', [$request->price1, $request->price2]);
    }

    // おいしさで絞り込み
    if ($request->status) {
      $query->where('status', $request->status);
    }

    $alcohols = $query->where('user_id', Auth::id())
      ->orderBy('updated_at', 'desc')
      ->paginate(10);

    $alcoholIds = $alcohols->pluck('id')->toArray();
    $images = Image::whereIn('alcohol_id', $alcoholIds)->get();
    $places = Alcohol::all()->unique('place');

    $total = $alcohols->total();
    $refineRecord = [
      $request->serch ?? null,
      $request->type ?? null,
      $request->place ?? null,
      $request->price1 ?? null,
      $request->price2 ?? null,
      $request->status ?? null,
    ];

    return view('alcohols.index', compact('alcohols', 'images', 'places', 'total', 'refineRecord'));
  }


  public function imagesIndex()
  {
    // $images = Image::all()->groupBy(function ($image) {
    //   return $image->created_at->format('Y年m月');
    // });

    $images = Image::whereHas('alcohols', function ($query) {
      $query->where('user_id', Auth::id());
    })
      ->get()
      ->groupBy(function ($image) {
        return $image->created_at->format('Y年m月');
      });

    return view('alcohols.images', compact('images'));
  }


  public function create()
  {
    $alcohols = Alcohol::where('user_id', Auth::id())->get();
    $places = $alcohols->unique('place');
    return view('alcohols.create', compact('places'));
  }


  public function store(StoreRequest $request)
  {
    $newPlace = $request->new_place;
    $selectedPlace = $request->place;

    $place = $newPlace ? $newPlace : $selectedPlace;

    $alcohol = Alcohol::create([
      'user_id' => Auth::id(),
      'alc_name' => $request->alc_name,
      'price' => $request->price,
      'place' => $place,
      'status' => $request->status,
      'type' => $request->type,
      'memo' => $request->memo,
    ]);

    if ($request->hasFile('files')) {
      $files = $request->file('files');

      foreach ($files as $file) {
        $randFileName = uniqid();
        $extension = $file->getClientOriginalExtension(); //拡張子を抽出
        $originalFileName = $randFileName . '.' . $extension;

        $path = $file->storeAs('public/imgs/' . $originalFileName);

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


  public function update(StoreRequest $request, string $id)
  {
    $update_data = Alcohol::find($id);

    $update_data->user_id = Auth::id();
    $update_data->alc_name = $request->alc_name;
    $update_data->price = $request->price;
    $update_data->type = $request->type;
    $update_data->status = $request->status;
    $update_data->memo = $request->memo;

    $newPlace = $request->new_place;
    $selectedPlace = $request->place;

    if ($newPlace) {
      $update_data->place = $newPlace;
    } elseif ($selectedPlace) {
      $update_data->place = $selectedPlace;
    }

    $update_data->save();

    if ($request->hasFile('files')) {
      $files = $request->file('files');
      $existingFiles = Image::where('alcohol_id', $id)->count();
      $totalFiles = count($files) + $existingFiles;

      if ($totalFiles > 3) {
        return back()->with('messe', '画像は3枚までです。');
      } else {

        foreach ($files as $file) {
          $randFileName = uniqid();
          $extension = $file->getClientOriginalExtension(); //拡張子を抽出
          $originalFileName = $randFileName . '.' . $extension;

          $path = $file->storeAs('public/imgs/' . $originalFileName);

          Image::create([
            'alcohol_id' => $update_data->id,
            'original_file_name' => $originalFileName,
            'path' => $path,
          ]);
        };
      }
    };

    return to_route('alcohols.index');
  }


  public function destroy(string $id)
  {
    $alcohol = Alcohol::findOrFail($id);
    $alcohol->delete();

    $images = Image::where('alcohol_id', $alcohol->id)->get();
    foreach ($images as $image) {
      $image->delete();
    }

    return to_route('alcohols.index');
  }


  public function dustBox()
  {
    $deleted_datas = Alcohol::onlyTrashed()->where('user_id', Auth::id())->paginate(10);
    $alcoholIds = Alcohol::onlyTrashed()->where('user_id', Auth::id())->pluck('id')->toArray();
    $images = Image::onlyTrashed()->whereIn('alcohol_id', $alcoholIds)->get();

    return view('alcohols.dust-box', compact('deleted_datas', 'images'));
  }


  public function restore($id)
  {
    $onlyTrashed = Alcohol::onlyTrashed()->find($id);
    $onlyTrashed_image = Image::onlyTrashed()->where('alcohol_id', $onlyTrashed->id)->get();;

    $onlyTrashed->restore();
    foreach ($onlyTrashed_image as $image) {
      $image->restore();
    }

    return to_route('alcohols.dust-box');
  }


  public function dustBoxClear(string $id)
  {
    $alcohol = Alcohol::onlyTrashed()->findOrFail($id);
    $paths = $alcohol->images()->onlyTrashed()->pluck('path');

    foreach ($paths as $path) {
      if (Storage::exists($path)) {
        Storage::delete($path);
      }
    }

    Alcohol::onlyTrashed()->findOrFail($id)->forceDelete();

    return to_route('alcohols.dust-box');
  }
}
