@extends('app')

@section('content')
  <x-header></x-header>
  
  <div class="mx-auto max-w-2xl mt-4">
    <h2 class="font-bold mb-4 text-2xl">Laporan Antrian</h2>

    <div class="w-full rounded-lg bg-white shadow-lg">
      <div class="overflow-hidden w-full rounded-lg">
        <table class="min-w-full">
          <tr class="bg-gray-50">
            <th class="py-3 px-5 text-left">Tanggal</th>
            <th class="py-3 px-5 text-right">Jumlah</th>
          </tr>

          @foreach ($counters as $item)  
            <tr class="border-t">
              <td class="py-2 px-5 text-left">{{ $item->date->format('d M Y') }}</td>
              <td class="py-2 px-5 text-right">{{ $item->current }}</td>
            </tr>
          @endforeach
        </table>
      </div>
    </div>
    
    <div class="mt-5">
      {{ $counters->links() }}
    </div>
  </div>
@endsection