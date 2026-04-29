

<x-app-layout>
    <x-slot name="header">
        <h2>Edit Kategori</h2>
    </x-slot>

    <div class="p-6">
        <form action="{{ route('admin.kategori.update', $kategori->id) }}" method="POST">
            @csrf
            @method('PUT')

            <input type="text" name="nama_kategori" value="{{ $kategori->nama_kategori }}" class="border p-2">
            <button class="bg-green-500 text-white px-3 py-2">Update</button>
        </form>
    </div>
</x-app-layout>