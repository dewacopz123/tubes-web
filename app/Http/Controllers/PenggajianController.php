<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PenggajianRepositoryInterface;
use App\Repositories\KaryawanRepositoryInterface;

class PenggajianController extends Controller
{
    protected $penggajianRepo;
    protected $karyawanRepo;

    public function __construct(
        PenggajianRepositoryInterface $penggajianRepo,
        KaryawanRepositoryInterface $karyawanRepo
    ) {
        $this->penggajianRepo = $penggajianRepo;
        $this->karyawanRepo  = $karyawanRepo;
    }

    /**
     * =====================
     * TAMPILKAN DATA
     * =====================
     */
    public function index()
    {
        return view('Penggajian.penggajian', [
            'penggajians' => $this->penggajianRepo->getAll(),
            'karyawans'   => $this->karyawanRepo->all()
        ]);
    }

    /**
     * =====================
     * SIMPAN DATA BARU
     * =====================
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'karyawan_id' => 'required|exists:karyawans,id',
            'tanggal'     => 'required|date',
            'gaji_pokok'  => 'required|numeric|min:0'
        ]);

        $this->penggajianRepo->store($validated);

        return response()->json([
            'status'  => 'success',
            'message' => 'Data penggajian berhasil ditambahkan'
        ]);
    }

    /**
     * =====================
     * AMBIL DATA UNTUK EDIT
     * =====================
     */
    public function edit($id)
    {
        return response()->json(
            $this->penggajianRepo->find($id)
        );
    }

    /**
     * =====================
     * UPDATE DATA
     * =====================
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'karyawan_id' => 'required|exists:karyawans,id',
            'tanggal'     => 'required|date',
            'gaji_pokok'  => 'required|numeric|min:0'
        ]);

        $this->penggajianRepo->update($id, $validated);

        return response()->json([
            'status'  => 'success',
            'message' => 'Data penggajian berhasil diperbarui'
        ]);
    }

    /**
     * =====================
     * HAPUS DATA
     * =====================
     */
    public function destroy($id)
    {
        $this->penggajianRepo->delete($id);

        return response()->json([
            'status'  => 'success',
            'message' => 'Data penggajian berhasil dihapus'
        ]);
    }
}
