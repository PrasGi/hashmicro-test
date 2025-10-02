<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-center">Cek Persentase Karakter</h2>
  </x-slot>

  <div class="min-h-[70vh] flex items-center justify-center p-6">
    <div class="w-full max-w-2xl rounded-2xl bg-white shadow px-6 py-6">
      <form method="POST" action="{{ route('overlap.calc') }}" class="space-y-4">
        @csrf
        <div class="space-y-1">
          <label class="text-sm text-gray-700">Input A</label>
          <input name="inputA" placeholder="ABBCD" value="{{ old('inputA','ABBCD') }}"
                 class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
        </div>
        <div class="space-y-1">
          <label class="text-sm text-gray-700">Input B</label>
          <input name="inputB" placeholder="Gallant Duck" value="{{ old('inputB','Gallant Duck') }}"
                 class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
        </div>
        <label class="flex items-center gap-2">
          <input type="checkbox" name="sensitive" value="1" {{ old('sensitive',false) ? 'checked' : '' }}
                 class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500">
          <span>Case Sensitive</span>
        </label>

        <div class="flex items-center justify-end pt-2">
          <button
            class="px-5 py-2.5 rounded-lg bg-emerald-600 hover:bg-emerald-700 transition">
            Hitung
          </button>
        </div>
      </form>

      @if(session('pct') !== null)
        <div class="mt-5 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-center text-emerald-800">
          Hasil: <strong>{{ session('pct') }}%</strong>
        </div>
        <p class="mt-2 text-center text-sm text-gray-500">
          Contoh: ABBCD vs "Gallant Duck" → 20% (sensitive), 60% (non-sensitive)
        </p>
      @endif
    </div>
  </div>
</x-app-layout>
