<h1>Data Peminjaman</h1>

<a href="/peminjaman/create">Pinjam Alat</a>

@foreach($data as $p)
    <p>
        {{ $p->user->name }} -
        {{ $p->alat->nama_alat }} -
        {{ $p->status }}
    </p>
@endforeach