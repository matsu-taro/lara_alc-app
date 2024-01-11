<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Dashboard') }}
    </h2>
  </x-slot>

  <div class="serch-area">
    <p>文字から検索する</p>
    絞り込み検索
    <p>・タイプ</p>
    <p>・店舗</p>
    <p>・価格帯</p>
  </div>

  <div class="image-cards">
    @foreach ($images as $month => $monthImages)
      <div class="image-card">
        <p>{{ $month }}</p>
        <ul>
          @foreach ($monthImages as $image)
            <li>
              <a href="{{ route('alcohols.edit', $image->alcohols->id) }}">
                <img src="{{ asset('storage/' . $image->original_file_name) }}" alt="">
              </a>
            </li>
          @endforeach
        </ul>
      </div>
    @endforeach
  </div>
</x-app-layout>
