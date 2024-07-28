<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;


class BeritaController extends Controller
{
    public function indexBerita()
    {
        $berita = Berita::all();
        return view('Admin.Cs.berita', compact('berita'));
    }

    public function show($id_berita)
    {
        $Berita = Berita::where('id_berita', $id_berita)->first();
        return view('Admin.Cs.editberita', ['Berita' => $Berita]);
    }

    public function create()
    {
        return view('Admin.Cs.createberita');
    }

    public function storeBerita(Request $request)
    {
        $data = $request->all();

        //pengecekan file foto
        if ($request->file('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension(); // Mendapatkan ekstensi asli file
            $filename = time() . '.' . $extension; // Membuat nama file baru dengan ekstensi asli
            $data['foto'] = $file->storeAs('assets/pengaduan', $filename, 'public');
        }
        date_default_timezone_set('Asia/Bangkok');


        Berita::create([
            'judul' => $data['judul'],
            'deskripsi' => $data['deskripsi'],
            'foto' => $data['foto'],
        ]);

        return redirect()->route('indexBerita');
    }

    public function edit($id_berita)
    {
        $berita = Berita::where('id_berita', $id_berita)->first();
    
        if (!$berita) {
            return redirect()->back()->with('notif', 'Berita tidak ditemukan');
        }
    
        // Pastikan tanggal diubah menjadi objek Carbon
        
        
    
        return view('Admin.Cs.editberita', ['berita' => $berita]);
    }

    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);
        
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $berita->judul = $request->judul;
        $berita->deskripsi = $request->deskripsi;
    
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($berita->foto) {
                Storage::delete('public/' . $berita->foto);
            }
    
            // Simpan foto baru
            $path = $request->file('foto')->store('public/assets/pengaduan');
            // Simpan jalur relatif di database
            $berita->foto = 'assets/pengaduan/' . basename($path);
        }
    
        $berita->save();
    
        return redirect()->route('indexBerita')->with('success', 'Berita berhasil diperbarui.');
    }
    

    
    
    
public function destroy($id_berita)
{
    $berita = Berita::findOrFail($id_berita); 
    $berita->delete();
    return redirect()->route('indexBerita')->with('success', 'Data berhasil dihapus');
}
    
}    
