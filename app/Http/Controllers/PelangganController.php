<?php
namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index(Request $request)
    {
        // 1. Tentukan kolom yang mau difilter (sesuai name di select option view)
        $filterableColumns = ['gender'];

        // 2. Panggil scopeFilter di Model, kirim request dan daftar kolom
        $data['dataPelanggan'] = Pelanggan::filter($request, $filterableColumns)->paginate(10);

        // 3. Tambahkan appends agar filter tidak hilang saat klik halaman 2
        $data['dataPelanggan']->appends($request->all());

        return view('pelanggan.index', $data);
    }

    // ... (Biarkan function create, store, dll di bawahnya tetap sama) ...
    public function create()
    {
        return view('pelanggan.create');
    }

    public function store(Request $request)
    {
        $data['first_name'] = $request->first_name;
        $data['last_name']  = $request->last_name;
        $data['birthday']   = date('Y-m-d', strtotime($request->birthday));
        $data['gender']     = $request->gender;
        $data['email']      = $request->email;
        $data['phone']      = $request->phone;

        Pelanggan::create($data);
        return redirect()->route('pelanggan.create')->with('success', 'Penambahan Data Berhasil!');
    }

    public function destroy(string $id)
    {
         $pelanggan = Pelanggan::findOrFail($id);
         $pelanggan->delete();
         return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

    public function edit(string $id){}
    public function update(Request $request, string $id){}
    public function show(string $id){}
}
