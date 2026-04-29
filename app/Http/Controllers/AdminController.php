<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\User;
use App\Models\Peminjaman;
use App\Models\Alat;

class AdminController extends Controller
{
    // =======================
    // DASHBOARD STATISTIK
    // =======================

    public function dashboard()
    {
        $totalAlat        = Alat::sum('stok');
        $totalMenunggu    = Peminjaman::where('status', 'menunggu')->count();
        $totalDipinjam    = Peminjaman::where('status', 'disetujui')->count();
        $totalSelesai     = Peminjaman::where('status', 'kembali')->count();
        $totalPeminjaman  = Peminjaman::count();

        return view('admin.dashboard', compact(
            'totalAlat',
            'totalMenunggu',
            'totalDipinjam',
            'totalSelesai',
            'totalPeminjaman'
        ));
    }

    // =======================
    // PEMINJAMAN
    // =======================

    public function peminjaman()
    {
        $peminjamans = Peminjaman::with(['user', 'alat'])->get();
        return view('admin.peminjaman', compact('peminjamans'));
    }

    public function destroyPeminjaman($id)
    {
        Peminjaman::findOrFail($id)->delete();
        return redirect()->route('admin.peminjaman');
    }

    // =======================
    // USER
    // =======================

    public function user()
    {
        $users = User::all();
        return view('admin.user', compact('users'));
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('admin.user');
    }

    public function destroyUser($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('admin.user');
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit_user', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'name'  => 'required',
            'email' => 'required|email'
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('admin.user');
    }

    // =======================
    // KATEGORI
    // =======================

    public function kategori()
    {
        $kategoris = Kategori::all();
        return view('admin.kategori', compact('kategoris'));
    }

    public function storeKategori(Request $request)
    {
        $request->validate(['nama_kategori' => 'required']);
        Kategori::create(['nama_kategori' => $request->nama_kategori]);
        return redirect()->back();
    }

    public function destroyKategori($id)
    {
        Kategori::findOrFail($id)->delete();
        return redirect()->back();
    }

    public function editKategori($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function updateKategori(Request $request, $id)
    {
        $request->validate(['nama_kategori' => 'required']);
        Kategori::findOrFail($id)->update(['nama_kategori' => $request->nama_kategori]);
        return redirect('/admin/kategori');
    }

    // =======================
    // ALAT (dengan foto)
    // =======================

    public function alat()
    {
        $alats     = Alat::with('kategori')->get();
        $kategoris = Kategori::all();
        return view('admin.alat', compact('alats', 'kategoris'));
    }

    public function storeAlat(Request $request)
    {
        $request->validate([
            'nama_alat'   => 'required',
            'kategori_id' => 'required',
            'stok'        => 'required|integer|min:0',
            'foto'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->only(['nama_alat', 'kategori_id', 'stok']);

        if ($request->hasFile('foto')) {
            $file       = $request->file('foto');
            $filename   = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/alat'), $filename);
            $data['foto'] = 'images/alat/' . $filename;
        }

        Alat::create($data);
        return redirect()->back()->with('success', 'Alat berhasil ditambahkan!');
    }

    public function destroyAlat($id)
    {
        $alat = Alat::findOrFail($id);

        if ($alat->foto && file_exists(public_path($alat->foto))) {
            unlink(public_path($alat->foto));
        }

        $alat->delete();
        return redirect()->back()->with('success', 'Alat berhasil dihapus!');
    }

    public function editAlat($id)
    {
        $alat      = Alat::findOrFail($id);
        $kategoris = Kategori::all();
        return view('admin.edit_alat', compact('alat', 'kategoris'));
    }

    public function updateAlat(Request $request, $id)
    {
        $request->validate([
            'nama_alat'   => 'required',
            'kategori_id' => 'required',
            'stok'        => 'required|integer|min:0',
            'foto'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $alat = Alat::findOrFail($id);
        $data = $request->only(['nama_alat', 'kategori_id', 'stok']);

        if ($request->hasFile('foto')) {
            // Hapus foto lama
            if ($alat->foto && file_exists(public_path($alat->foto))) {
                unlink(public_path($alat->foto));
            }

            $file         = $request->file('foto');
            $filename     = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/alat'), $filename);
            $data['foto'] = 'images/alat/' . $filename;
        }

        $alat->update($data);
        return redirect('/admin/alat')->with('success', 'Alat berhasil diupdate!');
    }
}