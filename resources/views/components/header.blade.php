
<div class="flex items-center py-2 px-3 mb-5 bg-gray-700 text-white">
  <h1 class="font-bold text-lg mr-3"><a href="{{ route('home') }}">Antrian</a></h1>

  <nav class="ml-auto flex items-center">
    <a href="{{ route('logout') }}" class="text-white hover:text-gray-100 font-semibold">Logout</a>
</nav>
</div>

<div class="mx-auto max-w-xl">
    <nav class="mt-4 font-semibold md:flex md:flex-shrink">
      <a href="{{ route('counter') }}" target="_blank" class="block p-5 text-indigo-500 hover:text-indigo-600 hover:bg-gray-50 hover:shadow-lg hp-5 rounded-lg bg-white shadow m-3 whitespace-nowrap">
        Display Antrian
      </a>

      <a href="javascript:void(0)" onClick="upCounter()" class="block p-5 text-indigo-500 hover:text-indigo-600 hover:bg-gray-50 hover:shadow-lg hp-5 rounded-lg bg-white shadow m-3 whitespace-nowrap">
        Antrian Berikutnya
      </a>

      <a href="javascript:void(0)" onClick="callAgain()" class="block p-5 text-indigo-500 hover:text-indigo-600 hover:bg-gray-50 hover:shadow-lg hp-5 rounded-lg bg-white shadow m-3 whitespace-nowrap">
        Panggil Ulang
      </a>

      <a href="{{ route('report') }}" class="block p-5 text-indigo-500 hover:text-indigo-600 hover:bg-gray-50 hover:shadow-lg hp-5 rounded-lg bg-white shadow m-3 whitespace-nowrap">
        Laporan
      </a>
    </nav>
</div>