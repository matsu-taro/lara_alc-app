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

    <form action="{{ route('alcohols.store') }}" method="post" enctype="multipart/form-data">
      @csrf

      <div class="data-block">
        <div class="data-left">
          <div class="">
            <input type="file" name="files[]" multiple accept=".png,.jpeg,.jpg" class="">
          </div>
        </div>

        <div class="data-right">
          <div class="">
            <label for="name" class="leading-7 text-md text-black-600">名前</label><br>
            <input type="text" name="name" placeholder="お酒の名前" value="{{ old('name') }}" id="name">
          </div>

          <div>
            <label for="price" class="leading-7 text-md text-black-600">値段</label><br>
              <span class="price-mark">¥</span><input type="number" name="price" placeholder="値段" value="{{ old('price') }}" id="price">
          </div>

          <div class="">
            <label for="new_place" class="leading-7 text-md text-black-600">買った or 飲んだお店</label><br>
            <input id="new_place" type="text" name="new_place" placeholder="新しく追加" value="{{ old('new_place') }}" class="">
          
            <select name="place" class="">
              <option value="0">お店のデータから選ぶ</option>
              {{-- @foreach ($users as $user) --}}
              {{-- <option value="{{ $user->name }}">{{ $user->name }}</option> --}}
              {{-- @endforeach --}}
            </select>
          </div>

          <div class="todo--status mt-6">
            <p>感情</p>
            <select name="status" class="">
              <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>うまい！</option>
              <option value="2" {{ old('status') == 2 ? 'selected' : '' }}>まあうまい</option>
              <option value="3" {{ old('status') == 3 ? 'selected' : '' }}>うん、おいしい</option>
            </select>
          </div>

          <div class="p-2 w-full flex my-8 gap-10">
            <button type="submit"
              class=" text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">作成する</button>
            <button type="button" onClick="history.back()"
              class=" bg-gray-300 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
          </div>
        </div>
      </div>
    </form>
  </main>
</x-app-layout>
