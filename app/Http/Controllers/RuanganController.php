<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    /**
     * Display a listing of all rooms.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        /** @var \Illuminate\Database\Eloquent\Collection|Ruangan[] $ruangans */
        $ruangans = Ruangan::query()->orderBy('nama_ruangan')->get();

        return view('baak.ruangan', compact('ruangans'));
    }

    /**
     * Store a newly created room in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_ruangan'        => 'required|string|max:255',
            'kapasitas'           => 'required|integer|min:1',
            'fasilitas'           => 'nullable|string|max:500',
            'status_ketersediaan' => 'required|boolean',
        ], [
            'nama_ruangan.required'        => 'Nama ruangan harus diisi.',
            'kapasitas.required'           => 'Kapasitas harus diisi.',
            'kapasitas.integer'            => 'Kapasitas harus berupa angka.',
            'kapasitas.min'                => 'Kapasitas minimal 1 orang.',
            'status_ketersediaan.required' => 'Status ketersediaan harus dipilih.',
        ]);

        Ruangan::query()->create([
            'nama_ruangan'        => $request->nama_ruangan,
            'kapasitas'           => $request->kapasitas,
            'fasilitas'           => $request->fasilitas,
            'status_ketersediaan' => $request->boolean('status_ketersediaan'),
        ]);

        return redirect()->route('baak.ruangan.index')->with('success', 'Ruangan "' . $request->nama_ruangan . '" berhasil ditambahkan.');
    }

    /**
     * Update the specified room in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
            'nama_ruangan'        => 'required|string|max:255',
            'kapasitas'           => 'required|integer|min:1',
            'fasilitas'           => 'nullable|string|max:500',
            'status_ketersediaan' => 'required|boolean',
        ]);

        /** @var Ruangan $ruangan */
        $ruangan = Ruangan::query()->findOrFail($id);

        $ruangan->update([
            'nama_ruangan'        => $request->nama_ruangan,
            'kapasitas'           => $request->kapasitas,
            'fasilitas'           => $request->fasilitas,
            'status_ketersediaan' => $request->boolean('status_ketersediaan'),
        ]);

        return redirect()->route('baak.ruangan.index')->with('success', 'Ruangan "' . $ruangan->nama_ruangan . '" berhasil diperbarui.');
    }

    /**
     * Remove the specified room from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id)
    {
        /** @var Ruangan $ruangan */
        $ruangan = Ruangan::query()->findOrFail($id);
        $nama    = $ruangan->nama_ruangan;
        $ruangan->delete();

        return redirect()->route('baak.ruangan.index')->with('success', 'Ruangan "' . $nama . '" berhasil dihapus.');
    }
}
