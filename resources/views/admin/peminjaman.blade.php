<x-app-layout>

<div class="p-6 max-w-7xl mx-auto">

    <h2 class="text-2xl font-bold mb-6">Data Peminjaman</h2>

    <div class="bg-white shadow-md rounded-xl p-6">

        <div class="mb-4 flex justify-end">
            <button onclick="printTable()"
                class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 9V2h12v7M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2M6 14h12v8H6v-8z" />
                </svg>
                Cetak
            </button>
        </div>

        <div class="overflow-x-auto">
            <table id="table-peminjaman" class="w-full text-sm">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="p-3">No</th>
                        <th class="p-3">Foto</th>
                        <th class="p-3">User</th>
                        <th class="p-3">Alat</th>
                        <th class="p-3">Jumlah</th>
                        <th class="p-3">Tgl Pinjam</th>
                        <th class="p-3">Tgl Kembali</th>
                        <th class="p-3">Status</th>
                        <th class="p-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($peminjamans as $p)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="p-3">{{ $loop->iteration }}</td>

                        {{-- Foto Alat --}}
                        <td class="p-3">
                            @if($p->alat->foto)
                                <img src="{{ asset($p->alat->foto) }}" alt="{{ $p->alat->nama_alat }}"
                                     class="w-12 h-12 object-cover rounded-lg border">
                            @else
                                <div class="w-12 h-12 bg-gray-100 rounded-lg border flex items-center justify-center">
                                    <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif
                        </td>

                        <td class="p-3">{{ $p->user->name }}</td>
                        <td class="p-3 font-medium">{{ $p->alat->nama_alat }}</td>
                        <td class="p-3">{{ $p->jumlah }}</td>
                        <td class="p-3 text-gray-600">{{ $p->tanggal_pinjam }}</td>
                        <td class="p-3 text-gray-600">{{ $p->tanggal_kembali ?? '-' }}</td>

                        <td class="p-3">
                            @if($p->status == 'menunggu')
                                <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700 font-semibold">Menunggu</span>
                            @elseif($p->status == 'disetujui')
                                <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-700 font-semibold">Dipinjam</span>
                            @elseif($p->status == 'ditolak')
                                <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-600 font-semibold">Ditolak</span>
                            @elseif($p->status == 'kembali')
                                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700 font-semibold">Selesai</span>
                            @else
                                <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-600">{{ $p->status }}</span>
                            @endif
                        </td>

                        <td class="p-3 text-center">
                            <form action="{{ route('admin.peminjaman.destroy', $p->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Yakin mau hapus data ini?')"
                                    class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 text-xs">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="p-4 text-center text-gray-500">
                            Belum ada data peminjaman
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

<script>
function printTable() {
    var rows = document.querySelectorAll('#table-peminjaman tr');
    var printContent = '<table border="1" cellpadding="8" cellspacing="0" style="width:100%;border-collapse:collapse;">';

    rows.forEach(function(row, index) {
        printContent += '<tr>';
        var cells = row.querySelectorAll('th, td');
        cells.forEach(function(cell, colIndex) {
            // Skip kolom foto (index 1) saat print
            if (colIndex === 1) return;
            var tag = cell.tagName.toLowerCase();
            printContent += '<' + tag + ' style="padding:8px;border:1px solid #ccc;">' + cell.innerText + '</' + tag + '>';
        });
        printContent += '</tr>';
    });

    printContent += '</table>';

    var win = window.open('', '', 'width=900,height=700');
    win.document.write(`
        <html>
        <head>
            <title>Cetak Peminjaman</title>
            <style>
                body { font-family: Arial; padding: 20px; }
                h2 { text-align: center; }
                @media print { button { display: none; } }
            </style>
        </head>
        <body>
            <h2>Data Peminjaman</h2>
            ${printContent}
        </body>
        </html>
    `);
    win.document.close();
    win.print();
}
</script>

</x-app-layout>