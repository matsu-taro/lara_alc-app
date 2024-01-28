<x-app-layout>
  
  <x-create-btn />
  
  <x-sp-header />
  
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
