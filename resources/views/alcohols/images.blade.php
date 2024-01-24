<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Dashboard') }}
    </h2>
  </x-slot>

  <div class="create-btn">
    <a href="{{ route('alcohols.create') }}">
      <div class="create-btn-img">
        <img src="{{ asset('storage/5.png') }}" alt="" class="sp-none">
        <img src="{{ asset('storage/18.png') }}" alt="" class="pc-none">
      </div>
      <p>新規作成</p>
    </a>
  </div>

  <div class="sp-top-title">
    <ul>
      <li>
        <a href="{{ route('alcohols.index') }}">
          <div class="sp-top-img">
            <img src="{{ asset('storage/7.png') }}" alt="">
          </div>
          <p>リスト</p>
        </a>
      </li>
      <li>
        <a href="{{ route('alcohols.images') }}">
          <div class="sp-top-img">
            <img src="{{ asset('storage/8.png') }}" alt="">
          </div>
          <p>画像</p>
        </a>
      </li>
      <li>
        <a href="{{ route('alcohols.dust-box') }}">
          <div class="sp-top-img">
            <img src="{{ asset('storage/9.png') }}" alt="">
          </div>
          <p>ゴミ箱</p>
        </a>
      </li>
    </ul>
  </div>

  <div class="image-cards">
    @if ($images->count() == 0)
      <div class="empty-message">
        <p>画像はありません。</p>
      </div>
    @else
      @foreach ($images as $month => $monthImages)
        <div class="image-card">
          <p>{{ $month }}</p>
          <ul>
            @foreach ($monthImages as $image)
              @if ($image)
                <li>
                  <a href="{{ route('alcohols.index', ['#' . $image->alcohols->id]) }}">
                    <img src="{{ asset('storage/imgs/' . $image->original_file_name) }}" alt="">
                  </a>
                </li>
              @else
                <li>画像はありません。</li>
              @endif
            @endforeach
          </ul>
        </div>
      @endforeach
    @endif
  </div>

</x-app-layout>
