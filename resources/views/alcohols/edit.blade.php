<x-app-layout>
  <main class="main">

    {{-- @if ($errors->any())
      <div class="validation">
        <ul class="font-medium text-red-600">
          @foreach ($errors->all() as $error)
            <li>・{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif --}}

    <form action="{{ route('alcohols.update', ['alcohol' => $alcohol->id]) }}" method="post"
      enctype="multipart/form-data">
      @method('put')
      @csrf

      <div class="data-block">
        <div class="data-left">
          <div class="">
            <p>画像を3枚まで貼り付け可能です</p>
            <div class="image-select">
              <input type="file" name="files[]" multiple accept=".png,.jpeg,.jpg" class="">
            </div>
          </div>
          <div class="image-area">
            <ul>
              @foreach ($images as $image)
                <li>
                  <img src="{{ asset('storage/'.$image->original_file_name) }}" alt="">
                </li>
              @endforeach
            </ul>
          </div>
        </div>

        <div class="data-right">
          <div class="">
            <p>種類</p>
            <select name="type" class="">
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
            <label for="alc_name" class="leading-7 text-md text-black-600">名前</label><br>
            <input type="text" name="alc_name" placeholder="お酒の名前" value="{{ $alcohol->alc_name }}" id="name">
          </div>

          <div>
            <label for="price" class="leading-7 text-md text-black-600">値段</label><br>
            <span class="price-mark">¥</span><input type="number" name="price" value="{{ $alcohol->price }}"
              id="price">
          </div>

          <div class="">
            <label for="new_place" class="leading-7 text-md text-black-600">買った or 飲んだお店</label><br>
            <input id="new_place" type="text" name="new_place" placeholder="新しく追加" value="{{ old('new_place') }}"
              class="">

            <select name="place" class="">
              <option value="0">過去のデータから選ぶ</option>
              @foreach ($places as $place)
                <option value="{{ $place->place }}">{{ $place->place }}</option>
              @endforeach
            </select>
          </div>

          <div class="">
            <p>感情</p>
            <select name="status" class="">
              <option value="1" @if ($alcohol->status == '1') selected @endif>うまい！</option>
              <option value="2" @if ($alcohol->status == '2') selected @endif>まあうまい</option>
              <option value="3" @if ($alcohol->status == '3') selected @endif>うん、おいしい</option>
            </select>
          </div>

          <div class="">
            <textarea name="memo" value="" cols="50%" rows="2" placeholder="メモ">{{ $alcohol->memo }}</textarea>
          </div>

          <div class="p-2 w-full flex my-8 gap-10">
            <button type="submit"
              class=" text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">更新する</button>
            <button type="button" onClick="history.back()"
              class=" bg-gray-300 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
          </div>
        </div>
      </div>
    </form>
  </main>
</x-app-layout>
