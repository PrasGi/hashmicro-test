<x-app-layout>
  <x-slot name="header"><h2 class="font-semibold text-xl">Create Item</h2></x-slot>
  <div class="p-6">
    <form method="POST" action="{{ route('items.store') }}" class="space-y-4">
      @csrf
      <input name="name" placeholder="Name" value="{{ old('name') }}" class="border p-2 w-80">
      <input name="price" placeholder="Price" value="{{ old('price',0) }}" class="border p-2 w-80" type="number" step="0.01">
      <input name="stock" placeholder="Stock" value="{{ old('stock',0) }}" class="border p-2 w-80" type="number">
      <button class="px-4 py-2 bg-black text-white">Save</button>
    </form>
  </div>
</x-app-layout>
