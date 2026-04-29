<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-slate-800 tracking-tight">
                Dashboard Admin
            </h2>
            <div class="text-sm text-slate-500 font-medium bg-white px-4 py-2 rounded-full shadow-sm border border-slate-100">
                {{ now()->format('d F Y') }}
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-[#f8fafc] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- WELCOME CARD --}}
            <div class="relative overflow-hidden bg-slate-900 rounded-3xl shadow-2xl">
                <div class="absolute top-[-10%] right-[-5%] w-64 h-64 bg-red-500 rounded-full blur-3xl opacity-20"></div>
                <div class="relative p-8 md:p-12 flex flex-col md:flex-row md:items-center justify-between">
                    <div>
                        <h3 class="text-2xl md:text-3xl font-bold text-white">
                            Selamat Datang, {{ explode(' ', auth()->user()->name)[0] }}! 🔴
                        </h3>
                        <p class="text-slate-400 mt-2 max-w-md leading-relaxed">
                            Anda login sebagai <span class="text-red-400 font-semibold">Administrator</span>. Kelola data sistem peminjaman alat dari sini.
                        </p>
                    </div>
                    <div class="mt-6 md:mt-0">
                        <span class="inline-flex items-center px-4 py-2 rounded-xl bg-white/10 text-white border border-white/20 backdrop-blur-md">
                            <span class="relative flex h-3 w-3 mr-3">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
                            </span>
                            Mode Admin
                        </span>
                    </div>
                </div>
            </div>

            {{-- PESAN SUKSES --}}
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl">
                    {{ session('success') }}
                </div>
            @endif

            {{-- KARTU STATISTIK --}}
            <div>
                <h3 class="text-lg font-bold text-slate-700 mb-4">📊 Statistik Peminjaman</h3>
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">

                    {{-- Total Stok Alat --}}
                    <div class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm hover:shadow-md transition-all">
                        <div class="flex items-center justify-between mb-3">
                            <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-blue-500 bg-blue-50 px-2 py-1 rounded-full">Stok</span>
                        </div>
                        <p class="text-3xl font-extrabold text-slate-800">{{ $totalAlat }}</p>
                        <p class="text-sm text-slate-500 mt-1">Total Barang</p>
                    </div>

                    {{-- Menunggu Verifikasi --}}
                    <div class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm hover:shadow-md transition-all">
                        <div class="flex items-center justify-between mb-3">
                            <div class="w-10 h-10 bg-yellow-50 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-yellow-500 bg-yellow-50 px-2 py-1 rounded-full">Pending</span>
                        </div>
                        <p class="text-3xl font-extrabold text-slate-800">{{ $totalMenunggu }}</p>
                        <p class="text-sm text-slate-500 mt-1">Menunggu Verifikasi</p>
                    </div>

                    {{-- Sedang Dipinjam --}}
                    <div class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm hover:shadow-md transition-all">
                        <div class="flex items-center justify-between mb-3">
                            <div class="w-10 h-10 bg-orange-50 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-orange-500 bg-orange-50 px-2 py-1 rounded-full">Aktif</span>
                        </div>
                        <p class="text-3xl font-extrabold text-slate-800">{{ $totalDipinjam }}</p>
                        <p class="text-sm text-slate-500 mt-1">Proses Dipinjam</p>
                    </div>

                    {{-- Peminjaman Selesai --}}
                    <div class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm hover:shadow-md transition-all">
                        <div class="flex items-center justify-between mb-3">
                            <div class="w-10 h-10 bg-emerald-50 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-emerald-600 bg-emerald-50 px-2 py-1 rounded-full">Selesai</span>
                        </div>
                        <p class="text-3xl font-extrabold text-slate-800">{{ $totalSelesai }}</p>
                        <p class="text-sm text-slate-500 mt-1">Peminjaman Selesai</p>
                    </div>

                </div>
            </div>

            {{-- MENU ADMIN --}}
            <div>
                <h3 class="text-lg font-bold text-slate-700 mb-4">⚙️ Menu Kelola</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                    <div class="group relative bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                        <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center mb-4 group-hover:bg-blue-500 transition-colors duration-300">
                            <svg class="w-6 h-6 text-blue-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <h4 class="text-lg font-bold text-slate-800 mb-1">Kelola User</h4>
                        <p class="text-slate-500 text-sm mb-4">Tambah, edit, hapus akun pengguna.</p>
                        <a href="{{ route('admin.user') }}" class="inline-flex items-center font-semibold text-blue-600 hover:text-blue-700 text-sm transition-colors">
                            Buka &rarr;
                        </a>
                    </div>

                    <div class="group relative bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                        <div class="w-12 h-12 bg-yellow-50 rounded-2xl flex items-center justify-center mb-4 group-hover:bg-yellow-500 transition-colors duration-300">
                            <svg class="w-6 h-6 text-yellow-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                        </div>
                        <h4 class="text-lg font-bold text-slate-800 mb-1">Kelola Kategori</h4>
                        <p class="text-slate-500 text-sm mb-4">Atur kategori alat yang tersedia.</p>
                        <a href="{{ route('admin.kategori') }}" class="inline-flex items-center font-semibold text-yellow-600 hover:text-yellow-700 text-sm transition-colors">
                            Buka &rarr;
                        </a>
                    </div>

                    <div class="group relative bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                        <div class="w-12 h-12 bg-emerald-50 rounded-2xl flex items-center justify-center mb-4 group-hover:bg-emerald-500 transition-colors duration-300">
                            <svg class="w-6 h-6 text-emerald-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                        <h4 class="text-lg font-bold text-slate-800 mb-1">Kelola Alat</h4>
                        <p class="text-slate-500 text-sm mb-4">Tambah dan kelola data inventaris alat.</p>
                        <a href="{{ route('admin.alat') }}" class="inline-flex items-center font-semibold text-emerald-600 hover:text-emerald-700 text-sm transition-colors">
                            Buka &rarr;
                        </a>
                    </div>

                    <div class="group relative bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                        <div class="w-12 h-12 bg-purple-50 rounded-2xl flex items-center justify-center mb-4 group-hover:bg-purple-500 transition-colors duration-300">
                            <svg class="w-6 h-6 text-purple-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <h4 class="text-lg font-bold text-slate-800 mb-1">Peminjaman</h4>
                        <p class="text-slate-500 text-sm mb-4">Pantau semua data peminjaman alat.</p>
                        <a href="{{ route('admin.peminjaman') }}" class="inline-flex items-center font-semibold text-purple-600 hover:text-purple-700 text-sm transition-colors">
                            Buka &rarr;
                        </a>
                    </div>

                </div>
            </div>

            {{-- PROFIL --}}
            <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-slate-500 text-sm">Login sebagai</p>
                    <p class="text-slate-800 font-semibold">{{ auth()->user()->name }} &mdash; <span class="text-red-500">Admin</span></p>
                </div>
                <a href="{{ route('profile.edit') }}" class="text-sm font-semibold text-slate-600 hover:text-slate-800 border border-slate-200 px-4 py-2 rounded-xl transition">
                    Edit Profil
                </a>
            </div>

        </div>
    </div>
</x-app-layout>