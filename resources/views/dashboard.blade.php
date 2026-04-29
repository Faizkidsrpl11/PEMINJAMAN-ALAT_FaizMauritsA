<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-slate-800 tracking-tight">
                {{ __('Dashboard') }}
            </h2>
            <div class="text-sm text-slate-500 font-medium bg-white px-4 py-2 rounded-full shadow-sm border border-slate-100">
                {{ now()->format('d F Y') }}
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-[#f8fafc] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

            <div class="relative overflow-hidden bg-slate-900 rounded-3xl shadow-2xl">
                <div class="absolute top-[-10%] right-[-5%] w-64 h-64 bg-blue-500 rounded-full blur-3xl opacity-20"></div>
                
                <div class="relative p-8 md:p-12 flex flex-col md:flex-row md:items-center justify-between">
                    <div>
                        <h3 class="text-2xl md:text-3xl font-bold text-white">
                            Selamat Datang Kembali, {{ explode(' ', auth()->user()->name)[0] }}! ✨
                        </h3>
                        <p class="text-slate-400 mt-2 max-w-md leading-relaxed">
                            Siap untuk bekerja hari ini? Kelola peminjaman alat Anda dengan lebih efisien dan terorganisir.
                        </p>
                    </div>
                    <div class="mt-6 md:mt-0">
                        <span class="inline-flex items-center px-4 py-2 rounded-xl bg-white/10 text-white border border-white/20 backdrop-blur-md">
                            <span class="relative flex h-3 w-3 mr-3">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                            </span>
                            Sistem Aktif
                        </span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <div class="group relative bg-white p-8 rounded-3xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-blue-500 transition-colors duration-300">
                        <svg class="w-7 h-7 text-blue-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-slate-800 mb-2">Pinjam Alat</h4>
                    <p class="text-slate-500 text-sm mb-6 leading-relaxed">
                        Cari alat yang tersedia dan ajukan peminjaman dalam hitungan detik.
                    </p>
                    <a href="#" class="inline-flex items-center font-semibold text-blue-600 hover:text-blue-700 transition-colors">
                        Mulai Pinjam 
                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>

                <div class="group relative bg-white p-8 rounded-3xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div class="w-14 h-14 bg-emerald-50 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-emerald-500 transition-colors duration-300">
                        <svg class="w-7 h-7 text-emerald-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-slate-800 mb-2">Riwayat</h4>
                    <p class="text-slate-500 text-sm mb-6 leading-relaxed">
                        Pantau status pengajuan dan cek kembali daftar peminjaman Anda.
                    </p>
                    <a href="#" class="inline-flex items-center font-semibold text-emerald-600 hover:text-emerald-700 transition-colors">
                        Lihat Detail
                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>

                <div class="group relative bg-white p-8 rounded-3xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div class="w-14 h-14 bg-purple-50 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-purple-500 transition-colors duration-300">
                        <svg class="w-7 h-7 text-purple-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-slate-800 mb-2">Profil Saya</h4>
                    <p class="text-slate-500 text-sm mb-6 leading-relaxed">
                        Perbarui informasi pribadi dan amankan akun Anda secara berkala.
                    </p>
                    <a href="{{ route('profile.edit') }}" class="inline-flex items-center font-semibold text-purple-600 hover:text-purple-700 transition-colors">
                        Pengaturan Akun
                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>