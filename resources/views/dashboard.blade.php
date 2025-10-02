<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-center">Dashboard</h2>
  </x-slot>

  <div class="min-h-[70vh] flex items-center justify-center">
    <div class="w-full max-w-xl text-center space-y-6">
      <div class="flex items-center justify-center gap-4">
        <a href="{{ route('items.index') }}"
           class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-700 transition">
          📦 CRUD Items
        </a>
        <a href="{{ route('overlap.page') }}"
           class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-emerald-600 hover:bg-emerald-700 transition">
          🧮 Cek Persentase
        </a>
      </div>
    </div>
  </div>
</x-app-layout>
