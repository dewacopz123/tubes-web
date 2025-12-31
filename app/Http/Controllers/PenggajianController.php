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

    public function index()
    {
        return view('Penggajian.penggajian', [
            'penggajians' => $this->penggajianRepo->getAll(),
            'karyawans'   => $this->karyawanRepo->all()
        ]);
    }

    public function create()
    {
        $karyawans = $this->karyawanRepo->all();
        return view('Penggajian.modal_form', compact('karyawans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'karyawan_id' => 'required|exists:karyawans,id',
            'tanggal'     => 'required|date',
            'gaji_pokok'  => 'required|numeric|min:0'
        ]);

        // Auto-generate kode penggajian
        $validated['kode_penggajian'] = 'PG-' . time();

        $penggajian = $this->penggajianRepo->store($validated);
        return response()->json([
            'status' => 'success',
            'message' => 'Data penggajian berhasil ditambahkan',
            'data' => $penggajian->load('karyawan')
        ]);
    }

    public function edit($id)
    {
        $penggajian = $this->penggajianRepo->find($id);
        $karyawans = $this->karyawanRepo->all();
        return view('Penggajian.modal_form', compact('penggajian', 'karyawans'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'karyawan_id' => 'required|exists:karyawans,id',
            'tanggal'     => 'required|date',
            'gaji_pokok'  => 'required|numeric|min:0'
        ]);

        $penggajian = $this->penggajianRepo->update($id, $validated);
        $updated = $this->penggajianRepo->find($id);
        return response()->json([
            'status' => 'success',
            'message' => 'Data penggajian berhasil diperbarui',
            'data' => $updated->load('karyawan')
        ]);
    }

    public function destroy($id)
    {
        $this->penggajianRepo->delete($id);
        return response()->json([
            'status' => 'success',
            'message' => 'Data penggajian berhasil dihapus'
        ]);
    }
}
