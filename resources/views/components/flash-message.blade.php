@props(['status' => 'true'])

@if (session('message'))
  <div class="w-1/2 mx-auto p-2">
    {{ session('message') }}
  </div>
@endif
