<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\KaryawanRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use App\Models\Karyawan;

class KaryawanController extends Controller
{
    protected $karyawanRepo;

    public function __construct(KaryawanRepositoryInterface $karyawanRepo)
    {
        $this->karyawanRepo = $karyawanRepo;
    }

    // TAMPIL DATA
    public function index()
    {
        $karyawans = $this->karyawanRepo->all();
        return view('DataKaryawan.data_karyawan', compact('karyawans'));
    }

    // FORM TAMBAH
    public function create()
    {
        return view('karyawan.create');
    }

    // SIMPAN DATA
    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:karyawans',
            'nama' => 'required',
            'email' => 'required|email|unique:karyawans',
            'telepon' => 'required|max:15',
            'role' => 'required|in:Admin,Karyawan',
            'status' => 'required|in:Aktif,Nonaktif'
        ]);


        Karyawan::create([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password), // 🔥 INI PENTING
            'telepon' => $request->telepon,
            'role' => $request->role,
            'status' => $request->status
        ]);


        return redirect()
            ->route('karyawan.index')
            ->with('success', 'Data karyawan berhasil ditambahkan');
    }

    // FORM EDIT
    public function edit($id)
    {
        $karyawan = $this->karyawanRepo->find($id);
        return view('karyawan.edit', compact('karyawan'));
    }

    // UPDATE DATA
    public function update(Request $request, $id)
    {
        $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            'email' => 'required|email',
            'telepon' => 'required|max:15',
            'role' => 'required|in:Admin,Karyawan',
            'status' => 'required|in:Aktif,Nonaktif'
        ]);

        $this->karyawanRepo->update($id, $request->all());

        return redirect()
            ->route('karyawan.index')
            ->with('success', 'Data karyawan berhasil diupdate');
    }

    // HAPUS DATA
    public function destroy($id)
    {
        $this->karyawanRepo->delete($id);

        return redirect()
            ->route('karyawan.index')
            ->with('success', 'Data karyawan berhasil dihapus');
    }
}
