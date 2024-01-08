<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Dashboard') }}
    </h2>
  </x-slot>

  <div class="serch-area">
    絞り込み検索
  </div>

  <div class="">
    <ul class="alc-cards">
      @foreach ($alcohols as $alcohol)
        <li class="alc-card">
          <a href="{{ route('alcohols.edit', ['alcohol' => $alcohol->id]) }}" class="alc-card-inner">
            <div class="alc-card-left">
              <div class="image-area">
                <ul>
                  @php
                    $alcoholImages = $images->where('alcohol_id', $alcohol->id)->take(3); // 特定のアルコールに関連する画像を取得（最大3枚）
                    $imageCount = count($alcoholImages);
                  @endphp

                  @foreach ($alcoholImages as $image)
                    <li>
                      <img src="{{ asset('storage/' . $image->original_file_name) }}" alt="">
                    </li>
                  @endforeach

                  @for ($i = $imageCount; $i < 3; $i++)
                    <li>
                      <img src="{{ asset('storage/noimage.png') }}" alt="">
                    </li>
                  @endfor
                </ul>
              </div>
            </div>
            <div class="alc-card-right">
              <p>
                @if ($alcohol->type == 1)
                  ビール
                @elseif($alcohol->type == 2)
                  サワー・酎ハイ
                @elseif($alcohol->type == 3)
                  ワイン
                @elseif($alcohol->type == 4)
                  日本酒
                @elseif($alcohol->type == 5)
                  焼酎
                @elseif($alcohol->type == 6)
                  洋酒
                @elseif($alcohol->type == 7)
                  その他
                @endif
              </p>
              <p>{{ $alcohol->alc_name }}</p>
              <p>¥{{ $alcohol->price }}</p>
              <p>{{ $alcohol->place }}</p>
              <p>
                @if ($alcohol->status == 1)
                  うまい！
                @elseif($alcohol->status == 2)
                  まあうまい
                @elseif($alcohol->status == 3)
                  うん、おいしい
                @endif
              </p>
            </div>
          </a>
          <div class="gomibako-btn">
            <form action="{{ route('alcohols.destroy', ['alcohol' => $alcohol->id]) }}" method="POST">
              @method('delete')
              @csrf
              <button>
                ゴミ箱へ
              </button>
            </form>
          </div>
        </li>
      @endforeach
    </ul>
  </div>
</x-app-layout>
