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
              <img src="{{ asset('storage/2.png') }}" alt="">
            </div>
            <select name="type" class="" style="display: block">
              <option value="">--種類--</option>
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
              <img src="{{ asset('storage/1.png') }}" alt="">
            </div>
            <input type="text" name="serch" placeholder="商品名 or メモ" value="{{ old('serch') }}">
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
          <li>
            <div class="serch-area-img">
              <img src="{{ asset('storage/3.png') }}" alt="">
            </div>
            <select name="place" class="">
              <option value="0">--お店--</option>
              @foreach ($places as $place)
                <option value="{{ $place }}" {{ old('place') == $place ? 'selected' : '' }}>
                  {{ $place }}
                </option>
              @endforeach
            </select>
          </li>
          <li>
            <div class="serch-area-img">
              <img src="{{ asset('storage/17.png') }}" alt="">
            </div>
            <select name="status" class="">
              <option value="0">--おいしさ--</option>
              <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>うまい！</option>
              <option value="2" {{ old('status') == 2 ? 'selected' : '' }}>おいしい</option>
              <option value="3" {{ old('status') == 3 ? 'selected' : '' }}>まぁまぁかな</option>
            </select>
          </li>
        </ul>
        <div class="serch-btns">
          @if ($refineRecord && array_filter($refineRecord))
            <a href="{{ route('alcohols.index') }}" class="serch-btn">戻る</a>
          @endif
          <button class="serch-btn">検索する</button>
        </div>
      </form>
    </div>
    @if ($refineRecord && array_filter($refineRecord))
      <div class="serch-results">
        検索結果：<span style="color: tomato;font-size:20px;margin:0 4px;font-weight: bold;">{{ $total }}</span>件
      </div>
    @endif
  </div>

  <div class="">
    @if ($alcohols->count() == 0)
      <div class="empty-message">
        <p>リストは0件です。<br>新しく作りましょう！</p>
      </div>
    @else
    <ul class="alc-cards">
      @foreach ($alcohols as $alcohol)
        <li class="alc-card" id="{{ $alcohol->id }}">
          <div class="type-name">
            @if ($alcohol->type == 1)
              <div class="type-name-icon">
                <img src="{{ asset('storage/10.png') }}" alt="">
              </div>
              <p>ビール</p>
            @elseif($alcohol->type == 2)
              <div class="type-name-icon">
                <img src="{{ asset('storage/11.png') }}" alt="">
              </div>
              <p>サワー・酎ハイ</p>
            @elseif($alcohol->type == 3)
              <div class="type-name-icon">
                <img src="{{ asset('storage/12.png') }}" alt="">
              </div>
              <p>ワイン</p>
            @elseif($alcohol->type == 4)
              <div class="type-name-icon">
                <img src="{{ asset('storage/13.png') }}" alt="">
              </div>
              <p>日本酒</p>
            @elseif($alcohol->type == 5)
              <div class="type-name-icon">
                <img src="{{ asset('storage/14.png') }}" alt="">
              </div>
              <p>焼酎</p>
            @elseif($alcohol->type == 6)
              <div class="type-name-icon">
                <img src="{{ asset('storage/15.png') }}" alt="">
              </div>
              <p>洋酒</p>
            @elseif($alcohol->type == 7)
              <div class="type-name-icon">
                <img src="{{ asset('storage/16.png') }}" alt="">
              </div>
              <p>その他</p>
            @endif
          </div>
          <div class="alc-card-inner">
            <div class="alc-card-inner-top">
              <div class="image-area list">
                <ul>
                  @php
                    $alcoholImages = $images->where('alcohol_id', $alcohol->id)->take(3); // 特定のアルコールに関連する画像を取得（最大3枚）
                    $imageCount = count($alcoholImages);
                  @endphp

                  @foreach ($alcoholImages as $image)
                    <li>
                      <img src="{{ asset('storage/imgs/' . $image->original_file_name) }}" alt="">
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
                    <span>{{ \Illuminate\Support\Str::limit($alcohol->alc_name, $limit = 22, $end = '...') }}</span>
                  </li>
                  <li class="alc-card-detail">
                    <p>値段</p>
                    <span>¥{{ $alcohol->price }}</span>
                  </li>
                  <li class="alc-card-detail">
                    <p>お店</p>
                    <span>{{ \Illuminate\Support\Str::limit($alcohol->place, $limit = 22, $end = '...') }}</span>
                  </li>
                  <li class="alc-card-detail">
                    <p>おいしさ</p>
                    <span>
                      @if ($alcohol->status == 1)
                        うまい！
                      @elseif($alcohol->status == 2)
                        おいしい
                      @elseif($alcohol->status == 3)
                        まぁまぁかな
                      @endif
                    </span>
                  </li>
                </ul>
              </div>
            </div>
            <div class="alc-card-detail alc-card-detail-memo">
              <p>メモ</p>
              <span>{{ \Illuminate\Support\Str::limit($alcohol->memo, $limit = 40, $end = '...') }}</span>
            </div>
          </div>
          <div class="alc-card-bottom">
            <form action="{{ route('alcohols.destroy', ['alcohol' => $alcohol->id]) }}" method="POST">
              @method('delete')
              @csrf
              <button>
                ゴミ箱へ
              </button>
            </form>
            <div>
              <a href="{{ route('alcohols.edit', ['alcohol' => $alcohol->id]) }}" class="">
                編集する
              </a>
            </div>
          </div>
        </li>
      @endforeach
    </ul>
    @endif
    {{ $alcohols->links() }}
  </div>
</x-app-layout>
