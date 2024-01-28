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

  <x-sp-header />

  <div class="">
    @if ($deleted_datas->count() == 0)
      <div class="empty-message">
        <p>ゴミ箱は空です。</p>
      </div>
    @else
      <ul class="alc-cards dust-boxs-cards">
        @foreach ($deleted_datas as $deleted_data)
          <li class="alc-card">
            <div class="type-name">
              @if ($deleted_data->type == 1)
                <div class="type-name-icon">
                  <img src="{{ asset('storage/10.png') }}" alt="">
                </div>
                <p>ビール</p>
              @elseif($deleted_data->type == 2)
                <div class="type-name-icon">
                  <img src="{{ asset('storage/11.png') }}" alt="">
                </div>
                <p>サワー・酎ハイ</p>
              @elseif($deleted_data->type == 3)
                <div class="type-name-icon">
                  <img src="{{ asset('storage/12.png') }}" alt="">
                </div>
                <p>ワイン</p>
              @elseif($deleted_data->type == 4)
                <div class="type-name-icon">
                  <img src="{{ asset('storage/13.png') }}" alt="">
                </div>
                <p>日本酒</p>
              @elseif($deleted_data->type == 5)
                <div class="type-name-icon">
                  <img src="{{ asset('storage/14.png') }}" alt="">
                </div>
                <p>焼酎</p>
              @elseif($deleted_data->type == 6)
                <div class="type-name-icon">
                  <img src="{{ asset('storage/15.png') }}" alt="">
                </div>
                <p>洋酒</p>
              @elseif($deleted_data->type == 7)
                <div class="type-name-icon">
                  <img src="{{ asset('storage/16.png') }}" alt="">
                </div>
                <p>その他</p>
              @endif
            </div>
            <div class="alc-card-inner">
              <div class="alc-card-inner-top">
                <div class="alc-card-left">

                  <div class="image-area list">
                    <ul>
                      @php
                        $alcoholImages = $images->where('alcohol_id', $deleted_data->id)->take(3); // 特定のアルコールに関連する画像を取得（最大3枚）
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
                </div>
                <div class="alc-card-right">
                  <ul>
                    <li class="alc-card-detail">
                      <p>名前</p>
                      <span>{{ \Illuminate\Support\Str::limit($deleted_data->alc_name, $limit = 22, $end = '...') }}</span>
                    </li>
                    <li class="alc-card-detail">
                      <p>値段</p>
                      <span>¥{{ $deleted_data->price }}</span>
                    </li>
                    <li class="alc-card-detail">
                      <p>お店</p>
                      <span>{{ \Illuminate\Support\Str::limit($deleted_data->place, $limit = 22, $end = '...') }}</span>
                    </li>
                    <li class="alc-card-detail">
                      <p>おいしさ</p>
                      <span>
                        @if ($deleted_data->status == 1)
                          うまい！
                        @elseif($deleted_data->status == 2)
                          おいしい
                        @elseif($deleted_data->status == 3)
                          まぁまぁかな
                        @endif
                      </span>
                    </li>
                  </ul>
                </div>
              </div>

              <div class="alc-card-detail alc-card-detail-memo">
                <p>メモ</p>
                <span>{{ \Illuminate\Support\Str::limit($deleted_data->memo, $limit = 40, $end = '...') }}</span>
              </div>
            </div>

            <div class="alc-card-bottom">
              <div class="restore-btn">
                <a href="{{ route('alcohols.restore', ['alcohol' => $deleted_data->id]) }}">
                  復元する
                </a>
              </div>
              <div class="gomibako-btn">
                <form action="{{ route('alcohols.dust-box_clear', ['alcohol' => $deleted_data->id]) }}" method="POST">
                  @csrf
                  <button>
                    完全に削除
                  </button>
                </form>
              </div>
            </div>
          </li>
        @endforeach
      </ul>
    @endif
  </div>
</x-app-layout>
