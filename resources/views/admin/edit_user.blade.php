<x-app-layout>
<div class="p-6 max-w-md">

    <h2 class="text-xl font-bold mb-4">Edit User</h2>

    <form action="{{ route('admin.user.update', $user->id) }}" method="POST" class="flex flex-col gap-3">
        @csrf
        @method('PUT')

        <input type="text" name="name" value="{{ $user->name }}"
            class="border rounded px-3 py-2">

        <input type="email" name="email" value="{{ $user->email }}"
            class="border rounded px-3 py-2">

        <button type="submit"
            class="bg-green-500 text-white py-2 rounded hover:bg-green-600">
            Update
        </button>
    </form>

</div>
</x-app-layout>