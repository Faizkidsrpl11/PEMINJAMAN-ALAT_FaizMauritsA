<x-app-layout>
<div class="p-6">

    <h2 class="text-2xl font-bold mb-6">Manajemen User</h2>

    {{-- CARD FORM --}}
    <div class="bg-white shadow rounded-lg p-4 mb-6">
        <h3 class="font-semibold mb-3">Tambah User</h3>

        <form action="{{ route('admin.user.store') }}" method="POST" class="grid grid-cols-4 gap-3">
            @csrf

            <input type="text" name="name" placeholder="Nama"
                class="border rounded px-3 py-2 w-full focus:outline-none focus:ring focus:ring-blue-200">

            <input type="email" name="email" placeholder="Email"
                class="border rounded px-3 py-2 w-full focus:outline-none focus:ring focus:ring-blue-200">

            <input type="password" name="password" placeholder="Password"
                class="border rounded px-3 py-2 w-full focus:outline-none focus:ring focus:ring-blue-200">

            <button type="submit"
                class="bg-blue-500 text-white rounded px-4 py-2 hover:bg-blue-600 transition">
                Tambah
            </button>
        </form>
    </div>

    {{-- CARD TABEL --}}
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="p-3 text-left">No</th>
                    <th class="p-3 text-left">Nama</th>
                    <th class="p-3 text-left">Email</th>
                    <th class="p-3 text-left">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($users as $user)
                <tr class="border-t hover:bg-gray-50">
                    <td class="p-3">{{ $loop->iteration }}</td>
                    <td class="p-3 font-medium">{{ $user->name }}</td>
                    <td class="p-3 text-gray-600">{{ $user->email }}</td>
                    <td class="p-3 flex gap-2">

                        {{-- EDIT --}}
                        <a href="{{ route('admin.user.edit', $user->id) }}"
                            class="bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500 transition">
                            Edit
                        </a>

                        {{-- HAPUS --}}
                        <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                onclick="return confirm('Yakin mau hapus user ini?')"
                                class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">
                                Hapus
                            </button>
                        </form>

                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-4 text-center text-gray-500">
                        Belum ada data user
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
</x-app-layout>