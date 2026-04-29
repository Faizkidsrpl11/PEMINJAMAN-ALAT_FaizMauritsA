<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Alat
        </h2>
    </x-slot>

    <div class="p-6 max-w-2xl mx-auto">
        <div class="bg-white shadow-md rounded-xl p-6">
            <h3 class="text-lg font-semibold mb-6">Edit Data Alat</h3>

            <form action="{{ route('admin.alat.update', $alat->id) }}" method="POST" enctype="multipart/form-data"
                  class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Alat</label>
                    <input type="text" name="nama_alat" value="{{ $alat->nama_alat }}" required
                        class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-200">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                    <select name="kategori_id" required
                        class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-200">
                        @foreach($kategoris as $k)
                            <option value="{{ $k->id }}" {{ $alat->kategori_id == $k->id ? 'selected' : '' }}>
                                {{ $k->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Stok</label>
                    <input type="number" name="stok" value="{{ $alat->stok }}" min="0" required
                        class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-200">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Foto Alat</label>

                    {{-- Preview foto yang sudah ada --}}
                    @if($alat->foto)
                        <div class="mb-3">
                            <p class="text-xs text-gray-500 mb-1">Foto saat ini:</p>
                            <img src="{{ asset($alat->foto) }}" alt="{{ $alat->nama_alat }}"
                                 class="w-24 h-24 object-cover rounded-lg border">
                        </div>
                    @endif

                    <input type="file" name="foto" accept="image/*"
                        class="w-full border rounded-lg p-1 text-sm focus:ring focus:ring-blue-200">
                    <p class="text-xs text-gray-400 mt-1">Kosongkan jika tidak ingin mengganti foto.</p>
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white rounded-lg px-6 py-2 font-medium">
                        Simpan
                    </button>
                    <a href="{{ route('admin.alat') }}"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg px-6 py-2 font-medium">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>