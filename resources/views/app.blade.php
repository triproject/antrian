<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title') Antrian</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="text-sm bg-gray-100 text-gray-700 min-h-screen pb-20">
  @yield('content')


  <x-footer />
  <script>
    const alertSound = new Audio("{{ url('/assets/audio/alert.mp3') }}");

    async function callAgain() {
      alertSound.currentTime = 0;
      alertSound.play();
    }

    async function upCounter() {
      const data = await fetch("{{ route('counter.up') }}");

      alertSound.currentTime = 0;
      alertSound.play()
    }
  </script>
</body>
</html>