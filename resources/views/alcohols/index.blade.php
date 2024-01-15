<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Dashboard') }}
    </h2>
  </x-slot>

  <div class="side-bar">
    <div class="create-btn">
      <a href="{{ route('alcohols.create') }}">
        新規作成
      </a>
    </div>

    <div class="serch">
      <form action="{{ route('alcohols.index') }}" method="get">
        <p>絞り込み検索</p>
        <ul>
          <li>
            <input type="text" name="serch" placeholder="商品名" value="{{ old('serch') }}">
          </li>
          <li>
            <select name="type" class="" style="display: block">
              <option value="">--タイプ--</option>
              <option value="1" {{ old('type') == 1 ? 'selected' : '' }}>ビール</option>
              <option value="2" {{ old('type') == 2 ? 'selected' : '' }}>サワー・酎ハイ</option>
              <option value="3" {{ old('type') == 3 ? 'selected' : '' }}>ワイン</option>
              <option value="4" {{ old('type') == 4 ? 'selected' : '' }}>日本酒</option>
              <option value="5" {{ old('type') == 5 ? 'selected' : '' }}>焼酎</option>
              <option value="6" {{ old('type') == 6 ? 'selected' : '' }}>洋酒</option>
              <option value="7" {{ old('type') == 7 ? 'selected' : '' }}>その他</option>
            </select>
          </li>
          <li>
            <select name="place" class="">
              <option value="0">--お店--</option>
              @foreach ($places as $place)
                <option value="{{ $place->place }}" {{ old('place') == $place->place ? 'selected' : '' }}>{{ $place->place }}
                </option>
              @endforeach
            </select>
          </li>
          <li>
            ¥<input type="number" name="price1" value="{{ old('price1') }}">〜¥<input type="number" name="price2" value="{{ old('price2') }}">
          </li>
        </ul>
        <button class="serch-btn">検索する</button>
      </form>
    </div>
    @if ($refineRecord && array_filter($refineRecord))
      <div class="" style="background-color: aliceblue;text-align:center;padding:8px 0;">
        表示件数：{{ $total }}件
      </div>
    @endif
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
                      <img src="{{ asset('storage/no-image.jpg') }}" alt="">
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
              <p>{{ $alcohol->memo }}</p>
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
    {{ $alcohols->links() }}
  </div>
</x-app-layout>
