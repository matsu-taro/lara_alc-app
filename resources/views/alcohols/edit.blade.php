<x-app-layout>
  <article class="main">

    <div class="create-btn">
      <a href="{{ route('alcohols.create') }}">
        <div class="create-btn-img">
          <img src="{{ asset('storage/5.png') }}" alt="" class="sp-none">
          <img src="{{ asset('storage/18.png') }}" alt="" class="pc-none">
        </div>
        <p>新規作成</p>
      </a>
    </div>

    <div class="pageTop-title">
      <p>編集画面</p>
    </div>

    <form action="{{ route('alcohols.update', ['alcohol' => $alcohol->id]) }}" method="post"
      enctype="multipart/form-data" class="createP-form">
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
                <input type="file" name="files[]" multiple accept=".png,.jpeg,.jpg" style="width: 100%">
              </div>
              <p>画像は3枚まで貼り付け可能です</p>
            </div>
            <div class="image-area inputP-image-area edit-image-area">
              <ul id="image-list">
                @php
                  $alcoholImages = $images->where('alcohol_id', $alcohol->id)->take(3); // 関連する画像を取得（最大3枚）
                  $imageCount = count($alcoholImages);
                  $displayedImageCount = min($imageCount, 3);
                @endphp
                @foreach ($alcoholImages as $image)
                  <li class="editP-image">
                    <img src="{{ asset('storage/imgs/' . $image->original_file_name) }}" alt="">
                    <a href="{{ route('images.destroy', ['image' => $image->id]) }}" class="editP-deleteBtn">削除</a>
                  </li>
                @endforeach

                @for ($i = $imageCount; $i < 3; $i++)
                  <li>
                    <img src="{{ asset('storage/no-image.jpg') }}" class="no-image no-image{{ $i + 1 }}">
                    <img src="" class="select-img select-img{{ $i + 1 }}">
                  </li>
                @endfor
              </ul>
            </div>
            <div style="text-align: right;margin-top:10px;width:100%;">
              <a href="#" class="img-select-clear">選びなおす</a>
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
              <input type="text" name="alc_name" placeholder="お酒の名前" value="{{ $alcohol->alc_name }}"
                id="name">
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
                <input id="new_place" type="text" name="new_place" placeholder="新しく追加する"
                  value="{{ old('new_place') }}" class="">

                <select name="place" class="">
                  <option value="0">過去のデータから選ぶ</option>
                  @foreach ($places as $place)
                    <option value="{{ $place }}" @if ($place == $alcohol->place) selected @endif>
                      {{ $place }}
                    </option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="">
              <span style="display: block">おいしさ</span>
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
        <div class="p-2 w-full flex justify-center my-2 gap-20">
          <button type="button" onClick="history.back()"
            class=" bg-gray-300 border-0 py-2 sm:px-8 px-2 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
          <button type="submit"
            class=" text-white bg-green-500 border-0 py-2 sm:px-8 px-2 focus:outline-none hover:bg-green-600 rounded text-lg">更新する</button>
        </div>
      </div>
    </form>
  </article>
</x-app-layout>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var fileInput = document.querySelector('input[name="files[]"]');
    var imageList = document.getElementById('image-list');
    var clearButton = document.querySelector('.img-select-clear');

    fileInput.addEventListener('change', function(event) {
      var files = event.target.files;
      var displayedImageCount = Math.min(files.length, 3);

      // すべての画像に対して初期化の処理
      for (var i = 1; i <= 3; i++) {
        var noImage = document.querySelector('.no-image' + i);
        var selectImg = document.querySelector('.select-img' + i);

        noImage.style.display = 'block';
        selectImg.style.display = 'none';
      }

      // 選択された各ファイルに対して処理
      Array.from(files).forEach(function(file, index) {
        if (index < displayedImageCount) {
          var noImage = document.querySelector('.no-image' + (index + 1));
          var selectImg = document.querySelector('.select-img' + (index + 1));

          // 画像を表示する処理
          var reader = new FileReader();
          reader.onload = function(e) {
            console.log(e.target.result);
            noImage.style.display = 'none';
            selectImg.src = e.target.result;
            selectImg.style.display = 'block';
          };
          reader.readAsDataURL(file);
        }
      });
    });

    clearButton.addEventListener('click', function() {
      var fileInput = document.querySelector('input[name="files[]"]');
      fileInput.value = null;

      // すべての画像に対して初期化の処理
      for (var i = 1; i <= 3; i++) {
        var noImage = document.querySelector('.no-image' + i);
        var selectImg = document.querySelector('.select-img' + i);

        noImage.style.display = 'block';
        selectImg.style.display = 'none';
      }
    });
  });
</script>
