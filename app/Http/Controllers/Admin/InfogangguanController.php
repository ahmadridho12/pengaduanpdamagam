<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Infogangguan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;


class InfogangguanController extends Controller
{
    public function indexInfogangguan()
    {
        $infogangguan = Infogangguan::all();
        return view('Admin.Cs.infogangguan', compact('infogangguan'));
    }

    public function show($id_gangguan)
    {
        $Infogangguan = Infogangguan::where('id_gangguan', $id_gangguan)->first();
        return view('Admin.Cs.editinfogangguan', ['Infogangguan' => $Infogangguan]);
    }

    public function create()
    {
        return view('Admin.Cs.createinfogangguan');
    }

    public function storeInfogangguan(Request $request)
    {
        $data = $request->all();
        date_default_timezone_set('Asia/Bangkok');


        Infogangguan::create([
            'tanggal' => date('Y-m-d h:i:s'),
            'judul' => $data['judul'],
            'deskripsi' => $data['deskripsi'],
            'status' => $data['status'],
        ]);

        return redirect()->route('indexInfogangguan');
    }

    public function edit($id_gangguan)
    {
        $infogangguan = Infogangguan::where('id_gangguan', $id_gangguan)->first();
    
        if (!$infogangguan) {
            return redirect()->back()->with('notif', 'Infogangguan tidak ditemukan');
        }
    
        // Pastikan tanggal diubah menjadi objek Carbon
        $infogangguan->tanggal = Carbon::parse($infogangguan->tanggal);
        
    
        return view('Admin.Cs.editinfogangguan', ['infogangguan' => $infogangguan]);
    }

    public function update(Request $request, $id_gangguan)
{
    $infogangguan = Infogangguan::find($id_gangguan);

    if (!$infogangguan) {
        return redirect()->back()->with('notif', 'Infogangguan tidak ditemukan');
    }

    $update = [];


    // Update data lainnya
    $infogangguan->update([
        'judul' => $request->input('judul'),
        'tanggal' => $request->input('tanggal'),
        'deskripsi' => $request->input('deskripsi'),
        'status' => $request->input('status'),
    ]);

    return redirect()->route('indexInfogangguan')->with('success', 'Data berhasil diperbarui');
}

    
    

    public function destroy($id_gangguan)
    {
        $infogangguan = Infogangguan::findOrFail($id_gangguan); 
        $infogangguan->delete();
        return redirect()->route('indexInfogangguan')->with('success', 'Data berhasil dihapus');
    }

    public function newView()
    {
        $infogangguan = Infogangguan::all();
        return view('user.new', ['infogangguan' => $infogangguan]);
    }
}
