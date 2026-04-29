<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800">
            Manajemen Kategori
        </h2>
    </x-slot>

    <div class="py-10 bg-gray-100 min-h-screen">
        <div class="max-w-5xl mx-auto space-y-8 px-6">

            <!-- FORM -->
            <div class="bg-white shadow-lg rounded-2xl p-6">
                <h3 class="text-lg font-semibold mb-4 text-gray-700">
                    Tambah Kategori
                </h3>

                <form action="{{ route('admin.kategori.store') }}" method="POST" class="space-y-3">
                    @csrf

                    <label class="text-sm font-medium text-gray-500">
                        Nama Kategori
                    </label>

                    <div class="flex gap-3">
                        <input type="text" name="nama_kategori"
                            placeholder="Contoh: Laptop, HP, dll..."
                            class="flex-1 border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none transition">

                        <button
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-medium shadow-md transition">
                            + Tambah
                        </button>
                    </div>
                </form>
            </div>

            <!-- TABEL -->
            <div class="bg-white shadow-lg rounded-2xl p-6">
                <h3 class="text-lg font-semibold mb-5 text-gray-700">
                    Daftar Kategori
                </h3>

                <div class="overflow-x-auto">
                    <table class="w-full border-separate border-spacing-y-3">
                        <thead>
                            <tr class="text-gray-500 text-sm">
                                <th class="text-left px-4">No</th>
                                <th class="text-left px-4">Nama Kategori</th>
                                <th class="text-center px-4">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($kategoris as $index => $kategori)
                                <tr class="bg-white hover:bg-gray-50 transition shadow-sm rounded-xl">
                                    
                                    <td class="px-4 py-3 text-gray-600">
                                        {{ $index + 1 }}
                                    </td>

                                    <td class="px-4 py-3 font-medium text-gray-800">
                                        {{ $kategori->nama_kategori }}
                                    </td>

                                    <td class="px-4 py-3">
                                        <div class="flex justify-center items-center gap-2">

                                            <!-- EDIT -->
                                            <a href="{{ route('admin.kategori.edit', $kategori->id) }}"
                                                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium shadow-sm transition">
                                                Edit
                                            </a>

                                            <!-- DELETE -->
                                            <form action="{{ route('admin.kategori.destroy', $kategori->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('Yakin hapus?')"
                                                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-medium shadow-sm transition">
                                                    Hapus
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-6 text-gray-400">
                                        Belum ada kategori 😢
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>