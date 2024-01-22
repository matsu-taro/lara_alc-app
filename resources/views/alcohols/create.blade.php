<x-app-layout>
  <article class="main">

    <div class="pageTop-title">
      <p>新規作成</p>
    </div>
    <form action="{{ route('alcohols.store') }}" method="post" enctype="multipart/form-data" class="createP-form">
      @csrf

      <div class="data-block">
        <div class="data-block-inner">

          <div class="data-left">
            <div class="">
              @error('files')
                <span class="text-red-600">{{ $message }}</span>
              @enderror
              <div class="image-select">
                <input type="file" name="files[]" multiple accept=".png,.jpeg,.jpg" style="width: 100%">
              </div>
              <p>画像は3枚まで貼り付け可能です</p>
            </div>
            <div class="image-area inputP-image-area">
              <ul>
                <li class="img-1">
                  <img src="{{ asset('storage/no-image.jpg') }}" alt="" class="no-image no-image1">
                  <img src="" alt="" class="select-img select-img1">
                </li>
                <li class="img-2">
                  <img src="{{ asset('storage/no-image.jpg') }}" alt="" class="no-image no-image2">
                  <img src="" alt="" class="select-img select-img2">
                </li>
                <li class="img-3">
                  <img src="{{ asset('storage/no-image.jpg') }}" alt="" class="no-image no-image3">
                  <img src="" alt="" class="select-img select-img3">
                </li>
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
                <option value="1" {{ old('type') == 1 ? 'selected' : '' }}>ビール</option>
                <option value="2" {{ old('type') == 2 ? 'selected' : '' }}>サワー・酎ハイ</option>
                <option value="3" {{ old('type') == 3 ? 'selected' : '' }}>ワイン</option>
                <option value="4" {{ old('type') == 4 ? 'selected' : '' }}>日本酒</option>
                <option value="5" {{ old('type') == 5 ? 'selected' : '' }}>焼酎</option>
                <option value="6" {{ old('type') == 6 ? 'selected' : '' }}>洋酒</option>
                <option value="7" {{ old('type') == 7 ? 'selected' : '' }}>その他</option>
              </select>
            </div>

            <div class="">
              <label for="alc_name" class="leading-7 text-md text-black-600">名前</label>
              @error('alc_name')
                <span class="text-red-600">{{ $message }}</span>
              @enderror
              <br>
              <input type="text" name="alc_name" placeholder="お酒の名前" value="{{ old('alc_name') }}" id="name">
            </div>

            <div>
              <label for="price" class="leading-7 text-md text-black-600">値段</label><br>
              <span class="price-mark">¥</span><input type="number" name="price" value="{{ old('price') }}"
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
                    <option value="{{ $place->place }}">{{ $place->place }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="">
              <span style="display: block">おいしさ</span>
              <select name="status" class="">
                <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>うまい！</option>
                <option value="2" {{ old('status') == 2 ? 'selected' : '' }}>おいしい</option>
                <option value="3" {{ old('status') == 3 ? 'selected' : '' }}>まぁまぁかな</option>
              </select>
            </div>

            <div class="">
              <textarea name="memo" value="" cols="50%" rows="2" placeholder="メモ(任意)">{{ old('memo') }}</textarea>
            </div>
          </div>
        </div>
        <div class="p-2 w-full flex justify-center my-2 gap-20">
          <button type="button" onClick="history.back()"
            class=" bg-gray-300 border-0 py-2 sm:px-8 px-3 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
          <button type="submit"
            class=" text-white bg-green-500 border-0 py-2 sm:px-8 px-2 focus:outline-none hover:bg-green-600 rounded text-lg">作成する</button>
        </div>
      </div>
    </form>

  </article>
</x-app-layout>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var fileInput = document.querySelector('input[name="files[]"]');
    var imageArea = document.querySelector('.image-area ul');
    var selectClearBtn = document.querySelector('.img-select-clear');

    fileInput.addEventListener('change', function(event) {
      var files = event.target.files;

      // すべての画像に対して初期化の処理
      for (var i = 1; i <= 3; i++) {
        var noImage = document.querySelector('.no-image' + i);
        var selectImg = document.querySelector('.select-img' + i);

        noImage.style.display = 'block';
        selectImg.style.display = 'none';
      }

      // 選択された各ファイルに対して処理
      Array.from(files).forEach(function(file, index) {
        if (index < 3) {
          var noImage = document.querySelector('.no-image' + (index + 1));
          var selectImg = document.querySelector('.select-img' + (index + 1));

          // 画像を表示する処理
          var reader = new FileReader();
          reader.onload = function(e) {
            noImage.style.display = 'none';
            selectImg.src = e.target.result;
            selectImg.style.display = 'block';
          };
          reader.readAsDataURL(file);
        }
      });
    });

    selectClearBtn.addEventListener('click', function() {
      // ファイル選択をクリア
      fileInput.value = '';

      // サムネイルを非表示にする
      for (var i = 1; i <= 3; i++) {
        var noImage = document.querySelector('.no-image' + i);
        var selectImg = document.querySelector('.select-img' + i);

        noImage.style.display = 'block';
        selectImg.style.display = 'none';
      }

      // 関連するエラーメッセージを非表示にする
      var errorMessage = document.querySelector('.text-red-600');
      if (errorMessage) {
        errorMessage.style.display = 'none';
      }

      // クリアしたことを確認するためにコンソールにメッセージを表示
      console.log('ファイルがクリアされました。');
    });
  });
</script>
