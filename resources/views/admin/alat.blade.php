<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Manajemen Alat
        </h2>
    </x-slot>

    <div class="p-6">

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- CARD FORM -->
        <div class="bg-white shadow-md rounded-xl p-6 mb-6">
            <h3 class="text-lg font-semibold mb-4">Tambah Alat</h3>

            <form action="{{ route('admin.alat.store') }}" method="POST" enctype="multipart/form-data"
                  class="grid grid-cols-1 md:grid-cols-5 gap-4 items-end">
                @csrf

                <input type="text" name="nama_alat" placeholder="Nama Alat" required
                    class="border rounded-lg p-2 focus:ring focus:ring-blue-200">

                <select name="kategori_id" required
                    class="border rounded-lg p-2 focus:ring focus:ring-blue-200">
                    <option disabled selected>Pilih Kategori</option>
                    @foreach($kategoris as $k)
                        <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                    @endforeach
                </select>

                <input type="number" name="stok" placeholder="Stok" min="0" required
                    class="border rounded-lg p-2 focus:ring focus:ring-blue-200">

                <div>
                    <label class="block text-xs text-gray-500 mb-1">Foto Alat (opsional)</label>
                    <input type="file" name="foto" accept="image/*"
                        class="border rounded-lg p-1 text-sm w-full focus:ring focus:ring-blue-200">
                </div>

                <button class="bg-blue-500 hover:bg-blue-600 text-white rounded-lg px-4 py-2">
                    + Tambah
                </button>
            </form>
        </div>

        <!-- TABLE -->
        <div class="bg-white shadow-md rounded-xl p-6">
            <h3 class="text-lg font-semibold mb-4">Daftar Alat</h3>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left border rounded-lg overflow-hidden">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="p-3">Foto</th>
                            <th class="p-3">Nama Alat</th>
                            <th class="p-3">Kategori</th>
                            <th class="p-3">Stok</th>
                            <th class="p-3 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($alats as $alat)
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td class="p-3">
                                @if($alat->foto)
                                    <img src="{{ asset($alat->foto) }}" alt="{{ $alat->nama_alat }}"
                                         class="w-14 h-14 object-cover rounded-lg border">
                                @else
                                    <div class="w-14 h-14 bg-gray-100 rounded-lg border flex items-center justify-center">
                                        <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif
                            </td>
                            <td class="p-3 font-medium">{{ $alat->nama_alat }}</td>
                            <td class="p-3">{{ $alat->kategori->nama_kategori }}</td>
                            <td class="p-3">
                                <span class="px-2 py-1 rounded {{ $alat->stok > 0 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-600' }} text-xs font-semibold">
                                    {{ $alat->stok }}
                                </span>
                            </td>
                            <td class="p-3 text-center space-x-2">
                                <a href="{{ route('admin.alat.edit', $alat->id) }}"
                                   class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-xs">
                                    Edit
                                </a>
                                <form action="{{ route('admin.alat.destroy', $alat->id) }}"
                                      method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Yakin hapus alat ini?')"
                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>    
                            <td colspan="5" class="p-4 text-center text-gray-500">
                                Belum ada data alat
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>