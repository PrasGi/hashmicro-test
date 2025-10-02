<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-center">Items</h2>
  </x-slot>

  <div class="min-h-[70vh] flex flex-col items-center justify-start p-6">
    <div class="w-full max-w-5xl flex justify-center">
      <div class="w-full">
        <div class="flex items-center justify-center mb-4">
          <button id="btnOpenModal"
                  class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-700 transition">
            ➕ Tambah Item
          </button>
        </div>

        @if(session('ok'))
          <div class="mx-auto mb-4 w-full max-w-2xl rounded-lg bg-emerald-50 text-emerald-800 px-4 py-3 text-center border border-emerald-200">
            {{ session('ok') }}
          </div>
        @endif

        <div class="overflow-x-auto rounded-xl border border-gray-200 shadow-sm">
          <table class="min-w-full divide-y divide-gray-200 mx-auto">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">ID</th>
                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Name</th>
                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Price</th>
                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Stock</th>
                <th class="px-4 py-3 text-right text-sm font-semibold text-gray-700">Actions</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 bg-white">
              @forelse($items as $it)
                <tr class="hover:bg-gray-50">
                  <td class="px-4 py-3 text-sm text-gray-700">#{{ $it->id }}</td>
                  <td class="px-4 py-3 text-sm text-gray-900 font-medium">{{ $it->name }}</td>
                  <td class="px-4 py-3 text-sm text-gray-700">Rp{{ number_format($it->price, 2) }}</td>
                  <td class="px-4 py-3 text-sm text-gray-700">{{ $it->stock }}</td>
                  <td class="px-4 py-3">
                    <div class="flex items-center justify-end gap-2">
                      <a href="{{ route('items.edit',$it->id) }}"
                         class="px-3 py-1.5 rounded-md bg-amber-500 hover:bg-amber-600 text-sm transition">Edit</a>
                      <form method="POST" action="{{ route('items.destroy',$it->id) }}"
                            onsubmit="return confirm('Hapus item ini?')">
                        @csrf @method('DELETE')
                        <button
                          class="px-3 py-1.5 rounded-md bg-rose-600 hover:bg-rose-700 text-sm transition">
                          Delete
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="5" class="px-4 py-8 text-center text-gray-500">Belum ada data.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  {{-- Modal Tambah Item --}}
  <div id="modalBackdrop" class="fixed inset-0 bg-black/50 hidden z-40"></div>
  <div id="modalBox"
       class="fixed inset-0 hidden z-50 flex items-center justify-center p-4">
    <div class="w-full max-w-lg rounded-2xl bg-white shadow-xl p-4">
      <div class="flex items-center justify-between border-b px-5 py-3">
        <h3 class="text-lg font-semibold">Tambah Item</h3>
        <button id="btnCloseModal" class="p-2 rounded-md hover:bg-gray-100">✕</button>
      </div>

      <form method="POST" action="{{ route('items.store') }}" class="p-5 space-y-4">
        @csrf
        <div class="space-y-1">
          <label class="text-sm text-gray-700">Name</label>
          <input name="name" required placeholder="Nama item"
                 class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <div class="grid grid-cols-2 gap-4">
          <div class="space-y-1">
            <label class="text-sm text-gray-700">Price</label>
            <input name="price" type="number" step="0.01" min="0" value="0"
                   class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
          </div>
          <div class="space-y-1">
            <label class="text-sm text-gray-700">Stock</label>
            <input name="stock" type="number" min="0" value="0"
                   class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
          </div>
        </div>

        <div class="flex items-center justify-end gap-2 pt-2">
          <button type="button" id="btnCancelModal"
                  class="px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-50 transition">
            Batal
          </button>
          <button type="submit"
                  class="px-4 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-700 transition">
            Simpan
          </button>
        </div>
      </form>
    </div>
  </div>

  <script>
    const openBtn = document.getElementById('btnOpenModal');
    const closeBtn = document.getElementById('btnCloseModal');
    const cancelBtn = document.getElementById('btnCancelModal');
    const box = document.getElementById('modalBox');
    const backdrop = document.getElementById('modalBackdrop');

    function openModal() { box.classList.remove('hidden'); backdrop.classList.remove('hidden'); }
    function closeModal() { box.classList.add('hidden'); backdrop.classList.add('hidden'); }

    openBtn?.addEventListener('click', openModal);
    closeBtn?.addEventListener('click', closeModal);
    cancelBtn?.addEventListener('click', closeModal);
    backdrop?.addEventListener('click', closeModal);
    window.addEventListener('keydown', (e)=> { if(e.key === 'Escape') closeModal(); });
  </script>
</x-app-layout>
