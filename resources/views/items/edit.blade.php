<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-center">Edit Item #{{ $item->id }}</h2>
  </x-slot>

  <div class="min-h-[70vh] flex items-center justify-center p-6">
    <div class="w-full max-w-lg rounded-2xl bg-white shadow px-6 py-6">
      <form method="POST" action="{{ route('items.update',$item->id) }}" class="space-y-4">
        @csrf @method('PUT')
        <div class="space-y-1">
          <label class="text-sm text-gray-700">Name</label>
          <input name="name" value="{{ old('name',$item->name) }}"
                 class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <div class="grid grid-cols-2 gap-4">
          <div class="space-y-1">
            <label class="text-sm text-gray-700">Price</label>
            <input name="price" type="number" step="0.01" value="{{ old('price',$item->price) }}"
                   class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
          </div>
          <div class="space-y-1">
            <label class="text-sm text-gray-700">Stock</label>
            <input name="stock" type="number" value="{{ old('stock',$item->stock) }}"
                   class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
          </div>
        </div>

        <div class="flex items-center justify-end gap-2 pt-2">
          <a href="{{ route('items.index') }}"
             class="px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-50 transition">Batal</a>
          <button class="px-4 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-700 transition">Update</button>
        </div>
      </form>
    </div>
  </div>
</x-app-layout>
