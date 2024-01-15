<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Dashboard') }}
    </h2>
  </x-slot>
  
  <div class="image-cards">
    @if ($images)
      @foreach ($images as $month => $monthImages)
        <div class="image-card">
          <p>{{ $month }}</p>
          <ul>
            @foreach ($monthImages as $image)
              @if ($image)
                <li>
                  <a href="{{ route('alcohols.edit', $image->alcohols->id) }}">
                    <img src="{{ asset('storage/' . $image->original_file_name) }}" alt="">
                  </a>
                </li>
              @else
                <li>画像はありません。</li>
              @endif
            @endforeach
          </ul>
        </div>
      @endforeach
    @else
      <p>画像はありません。</p>
    @endif
  </div>

</x-app-layout>
