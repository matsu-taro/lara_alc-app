<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Dashboard') }}
    </h2>
  </x-slot>

  <div class="">
    <ul class="alc-cards">
      @foreach ($deleted_datas as $deleted_data)
        <li class="alc-card">
          <a href="{{ route('alcohols.edit', ['alcohol' => $deleted_data->id]) }}" class="alc-card-inner">
            <div class="alc-card-left">

              <div class="image-area">
                <ul>
                  @foreach ($images->whereIn('alcohol_id', $deleted_data->id) as $image)
                    <li>
                      <img src="{{ asset('storage/' . $image->original_file_name) }}" alt="">
                    </li>
                  @endforeach
                </ul>
              </div>
            </div>
            <div class="alc-card-right">
              <p>
                @if ($deleted_data->type == 1)
                  ビール
                @elseif($deleted_data->type == 2)
                  サワー・酎ハイ
                @elseif($deleted_data->type == 3)
                  ワイン
                @elseif($deleted_data->type == 4)
                  日本酒
                @elseif($deleted_data->type == 5)
                  焼酎
                @elseif($deleted_data->type == 6)
                  洋酒
                @elseif($deleted_data->type == 7)
                  その他
                @endif
              </p>
              <p>{{ $deleted_data->alc_name }}</p>
              <p>¥{{ $deleted_data->price }}</p>
              <p>{{ $deleted_data->place }}</p>
              <p>
                @if ($deleted_data->status == 1)
                  うまい！
                @elseif($deleted_data->status == 2)
                  まあうまい
                @elseif($deleted_data->status == 3)
                  うん、おいしい
                @endif
              </p>
            </div>
          </a>

          <div class="btns">
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
  </div>
</x-app-layout>
