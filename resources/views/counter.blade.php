@extends('app')

@section('title', 'Nomor')

@section('content')
  <div class="fixed h-screen w-full overflow-hidden flex items-center justify-center">
    <div class="border rounded-lg  bg-white shadow-lg">
      <div class="mb-3 font-semibold text-2xl px-8 py-5 border-b">Nomor Antrian</div>
      <div id="current-counter" class="font-bold p-8" style="font-size: 13rem; line-height: 1;">
        {{ App\Models\Counter::getCurrent() }}
      </div>
    </div>
  </div>

  <script>
    const currentCounter = document.getElementById('current-counter');

    setInterval(async () => {
      const data = await fetch("{{ route('counter.current') }}");
      const newCounter = await data.text();
      currentCounter.innerHTML = newCounter;
    }, 1000);
  </script>
@endsection