<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\ValidatesSekData;
use Illuminate\Http\Request;
use App\Models\Jobdesk;
use App\Models\Karyawan;

class JobdeskController extends Controller
{
    use ValidatesSekData;

    // Tampilkan semua jobdesk
    public function index()
    {
        $jobdesks = Jobdesk::with('karyawan')->get();
        $karyawans = Karyawan::all(); // untuk select dropdown

        return view('Jobdesk.index', compact('jobdesks', 'karyawans'));
    }

    // Store
    public function store(Request $request)
    {
        $data = $request->validate(
            $this->jobdeskRules(),
            $this->validationMessages(),
            $this->validationAttributes()
        );

        $jobdesk = Jobdesk::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Jobdesk berhasil ditambahkan.',
            'data' => $jobdesk->load('karyawan:id,nama'),
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate(
            $this->jobdeskRules(),
            $this->validationMessages(),
            $this->validationAttributes()
        );

        $jobdesk = Jobdesk::findOrFail($id);
        $jobdesk->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Jobdesk berhasil diperbarui.',
            'data' => $jobdesk->load('karyawan:id,nama'),
        ]);
    }

    public function show($id)
    {
        return Jobdesk::findOrFail($id);
    }


    // Hapus jobdesk
    public function destroy($id)
    {
        Jobdesk::findOrFail($id)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Jobdesk berhasil dihapus.',
        ]);
    }


    public function form()
    {
        $karyawans = Karyawan::all();
        return view('Jobdesk.formAddEdit', compact('karyawans'));
    }

}
