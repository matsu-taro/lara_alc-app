<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="robots" content="noindex , nofollow" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="shortcut icon" href="{{ asset('storage/19.png') }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=M+PLUS+1p:wght@400;500;700&display=swap" rel="stylesheet">

  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/scss/style.scss'])
</head>

<body class="font-sans text-gray-900 antialiased">
  <div class="bg">
    <img src="{{ asset('storage/alc-bg.jpg') }}" alt="">
  </div>
  <div class="min-h-screen flex flex-col justify-center items-center">
    <div>
      <a href="/">
        <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
      </a>
    </div>

    <div class="w-full sm:max-w-md px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
      {{ $slot }}
    </div>
  </div>
</body>

</html>
