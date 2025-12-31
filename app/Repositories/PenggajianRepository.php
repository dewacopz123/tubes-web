<?php

namespace App\Repositories;

use App\Models\Penggajian;

class PenggajianRepository implements PenggajianRepositoryInterface
{
    public function getAll()
    {
        return Penggajian::with('karyawan')->get();
    }

    public function find($id)
    {
        return Penggajian::findOrFail($id);
    }

    public function store(array $data)
    {
        return Penggajian::create($data);
    }

    public function update($id, array $data)
    {
        return Penggajian::where('id', $id)->update($data);
    }

    public function delete($id)
    {
        return Penggajian::destroy($id);
    }
}
