<x-app-layout>
  <article class="main">

    <div class="pageTop-title">
      <p>確認・編集</p>
    </div>

    <form action="{{ route('alcohols.update', ['alcohol' => $alcohol->id]) }}" method="post" enctype="multipart/form-data"
      class="createP-form">
      @method('put')
      @csrf

      <div class="data-block">
        <div class="data-block-inner">
          <div class="data-left">
            <div class="editP-select-btn">
              @if (session('messe'))
                <span class="text-red-600">{{ session('messe') }}</span>
              @endif

              @error('files')
                <span class="text-red-600">{{ $message }}</span>
              @enderror
              <div class="image-select">
                <input type="file" name="files[]" multiple accept=".png,.jpeg,.jpg">
              </div>
              <p>画像は3枚まで貼り付け可能です</p>
            </div>
            <div class="image-area edit-image-area">
              <ul>
                @php
                  $alcoholImages = $images->where('alcohol_id', $alcohol->id)->take(3); // 特定のアルコールに関連する画像を取得（最大3枚）
                  $imageCount = count($alcoholImages);
                  $displayedImageCount = min($imageCount, 3);
                @endphp
                @foreach ($alcoholImages as $image)
                  <li class="editP-image">
                    <img src="{{ asset('storage/' . $image->original_file_name) }}" alt="">
                    <a href="{{ route('images.destroy', ['image' => $image->id]) }}" class="editP-deleteBtn">削除</a>
                  </li>
                @endforeach

                @for ($i = $imageCount; $i < 3; $i++)
                  <li>
                    <img src="{{ asset('storage/no-image.jpg') }}" alt="">
                  </li>
                @endfor
              </ul>
            </div>
          </div>

          <div class="data-right">
            <div class="">
              <span>種類</span>
              @error('type')
                <span class="text-red-600">{{ $message }}</span>
              @enderror
              <select name="type" class="" style="display: block">
                <option value="">選択してください</option>
                <option value="1" @if ($alcohol->type == '1') selected @endif>ビール</option>
                <option value="2" @if ($alcohol->type == '2') selected @endif>サワー・酎ハイ</option>
                <option value="3" @if ($alcohol->type == '3') selected @endif>ワイン</option>
                <option value="4" @if ($alcohol->type == '4') selected @endif>日本酒</option>
                <option value="5" @if ($alcohol->type == '5') selected @endif>焼酎</option>
                <option value="6" @if ($alcohol->type == '6') selected @endif>洋酒</option>
                <option value="7" @if ($alcohol->type == '7') selected @endif>その他</option>
              </select>
            </div>

            <div class="">
              <label for="alc_name" class="leading-7 text-md text-black-600">名前</label>
              @error('alc_name')
                <span class="text-red-600">{{ $message }}</span>
              @enderror
              <br>
              <input type="text" name="alc_name" placeholder="お酒の名前" value="{{ $alcohol->alc_name }}" id="name">
            </div>

            <div>
              <label for="price" class="leading-7 text-md text-black-600">値段</label><br>
              <span class="price-mark">¥</span><input type="number" name="price" value="{{ $alcohol->price }}"
                id="price">
            </div>

            <div class="place-select-area">
              <label for="new_place" class="leading-7 text-md text-black-600">買った or 飲んだお店</label>
              @error('place')
                <span class="text-red-600">{{ $message }}</span>
              @enderror
              <br>
              <div>
                <input id="new_place" type="text" name="new_place" placeholder="新しく追加"
                  value="{{ old('new_place') }}" class="">

                <select name="place" class="">
                  <option value="0">過去のデータから選ぶ</option>
                  @foreach ($places as $place)
                    <option value="{{ $place->place }}" @if ($place->place == $alcohol->place) selected @endif>
                      {{ $place->place }}
                    </option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="">
              <span style="display: block">感情</span>
              <select name="status" class="">
                <option value="1" @if ($alcohol->status == '1') selected @endif>うまい！</option>
                <option value="2" @if ($alcohol->status == '2') selected @endif>おいしい</option>
                <option value="3" @if ($alcohol->status == '3') selected @endif>まぁまぁかな</option>
              </select>
            </div>

            <div class="">
              <textarea name="memo" cols="50%" rows="2" placeholder="メモ(任意)">{{ $alcohol->memo }}</textarea>
            </div>
          </div>
        </div>
        <div class="p-2 w-full flex justify-center my-8 gap-20">
          <button type="submit"
            class=" text-white bg-green-500 border-0 py-2 sm:px-8 px-2 focus:outline-none hover:bg-green-600 rounded text-lg">更新する</button>
          <button type="button" onClick="history.back()"
            class=" bg-gray-300 border-0 py-2 sm:px-8 px-2 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
        </div>
      </div>
    </form>
  </article>
</x-app-layout>
