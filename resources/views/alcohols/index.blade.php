<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Dashboard') }}
    </h2>
  </x-slot>

  <div class="create-btn">
    <a href="{{ route('alcohols.create') }}">
      <div class="create-btn-img">
        <img src="{{ asset('storage/5.png') }}" alt="">
      </div>
      <p>新規作成</p>
    </a>
  </div>

  <div class="serch-block">
    <div class="serch">
      <form action="{{ route('alcohols.index') }}" method="get">
        <div class="serch-title">
          <div class="serch-area-img">
            <img src="{{ asset('storage/6.png') }}" alt="">
          </div>
          <p>絞り込み検索</p>
        </div>
        <ul>
          <li>
            <div class="serch-area-img">
              <img src="{{ asset('storage/1.png') }}" alt="">
            </div>
            <input type="text" name="serch" placeholder="商品名" value="{{ old('serch') }}">
          </li>
          <li>
            <div class="serch-area-img">
              <img src="{{ asset('storage/2.png') }}" alt="">
            </div>
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
            <div class="serch-area-img">
              <img src="{{ asset('storage/3.png') }}" alt="">
            </div>
            <select name="place" class="">
              <option value="0">--お店--</option>
              @foreach ($places as $place)
                <option value="{{ $place->place }}" {{ old('place') == $place->place ? 'selected' : '' }}>
                  {{ $place->place }}
                </option>
              @endforeach
            </select>
          </li>
          <li>
            <div class="serch-area-img">
              <img src="{{ asset('storage/4.png') }}" alt="">
            </div>
            <div style="display: flex;justify-content: center;align-items: center; width: 100%;">
              <input class="serch-price" type="number" name="price1" value="{{ old('price1') }}"
                placeholder="¥"><span>〜</span><input class="serch-price" type="number" name="price2"
                value="{{ old('price2') }}" placeholder="¥">
            </div>
          </li>
        </ul>
        <div class="serch-btns">
          <button class="serch-btn">検索する</button>
          @if ($refineRecord && array_filter($refineRecord))
            <button type="button" onClick="history.back()" class="serch-btn">戻る</button>
          @endif
        </div>
      </form>
    </div>
    @if ($refineRecord && array_filter($refineRecord))
      <div class="serch-results">
        検索結果：<span style="color: tomato;font-size:20px;margin:0 4px;">{{ $total }}</span>件
      </div>
    @endif
  </div>

  <div class="">
    <ul class="alc-cards">
      @foreach ($alcohols as $alcohol)
        <li class="alc-card">
          <p>
            <span>
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
            </span>
          </p>
          <div class="alc-card-inner">
            <div class="alc-card-inner-top">
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

              <div class="alc-card-right">
                <ul>
                  <li class="alc-card-detail">
                    <p>名前</p>
                    <span>{{ $alcohol->alc_name }}</span>
                  </li>
                  <li class="alc-card-detail">
                    <p>値段</p>
                    <span>¥{{ $alcohol->price }}</span>
                  </li>
                  <li class="alc-card-detail">
                    <p>お店</p>
                    <span>{{ $alcohol->place }}</span>
                  </li>
                  <li class="alc-card-detail">
                    <p>おいしさ</p>
                    <span>
                      @if ($alcohol->status == 1)
                        うまい！
                      @elseif($alcohol->status == 2)
                        まあうまい
                      @elseif($alcohol->status == 3)
                        うん、おいしい
                      @endif
                    </span>
                  </li>
                </ul>
              </div>
            </div>
            <div class="alc-card-detail alc-card-detail-memo">
              <p>メモ</p>
              <span>{{ $alcohol->memo }}</span>
            </div>
          </div>
          <div class="alc-card-bottom">
            <div>
              <a href="{{ route('alcohols.edit', ['alcohol' => $alcohol->id]) }}" class="">
                確認・編集
              </a>
            </div>
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
