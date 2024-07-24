<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Direktur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;


class DirekturController extends Controller
{
    public function indexdirektur()
    {
        $direktur = Direktur::all();
        return view('Admin.Arsip.indexdirektur', compact('direktur'));
    }

    public function show($id_direktur)
    {
        $direktur = Direktur::where('id_direktur', $id_direktur)->first();
        return view('Admin.Arsip.showdirektur', ['direktur' => $direktur]);
    }

    public function create()
    {
        return view('Admin.Arsip.createdirektur');
    }

    public function storeDirektur(Request $request)
    {
        $data = $request->all();
        date_default_timezone_set('Asia/Bangkok');

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('mou_files', $fileName, 'public');

            $data['file'] = $fileName; // Simpan hanya nama file di database
        }

        

        Direktur::create([
            'tgl_berlaku' => date('Y-m-d h:i:s'),
            'tgl_ditetapkan' => date('Y-m-d h:i:s'),
            'judul' => $data['judul'],
            'nomor' => $data['nomor'],
            'status' => $data['status'],
            'file' => $data['file'],
        ]);

        return redirect()->route('indexdirektur');
    }

    public function edit($id_direktur)
    {
        $direktur = Direktur::where('id_direktur', $id_direktur)->first();
    
        if (!$direktur) {
            return redirect()->back()->with('notif', 'SK Direktur tidak ditemukan');
        }
    
        // Pastikan tanggal diubah menjadi objek Carbon
       
        
    
        return view('Admin.Arsip.editdirektur', ['direktur' => $direktur]);
    }

    public function update(Request $request, $id_direktur)
{
    $direktur = direktur::find($id_direktur);

    if (!$direktur) {
        return redirect()->back()->with('notif', 'SK Direktur tidak ditemukan');
    }

    $update = [];

    if ($request->hasFile('file')) {
        // Hapus file lama jika ada
        if ($direktur->file && Storage::disk('public')->exists('mou_files/' . $direktur->file)) {
            Storage::disk('public')->delete('mou_files/' . $direktur->file);
        }

        // Upload file baru
        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('mou_files', $fileName, 'public');

        $update['file'] = $fileName; // Simpan nama file baru di database
    } else {
        // Jika tidak ada file baru, gunakan file lama
        $update['file'] = $direktur->file;
    }

    // Update data lainnya
    $direktur->update([
        'judul' => $request->input('judul'),
        'keterangan' => $request->input('keterangan'),
        'nomor' => $request->input('nomor'),
        'tgl_berlaku' => $request->input('tgl_berlaku'),
        'tgl_ditetapkan' => $request->input('tgl_ditetapkan'),
        'status' => $request->input('status'),
        'file' => $update['file'], // Update nama file di database
    ]);

    return redirect()->route('indexdirektur')->with('success', 'Data berhasil diperbarui');
}

    
    

    public function destroy($id_direktur)
    {
        $mou = Direktur::findOrFail($id_direktur); 
        $mou->delete();
        return redirect()->route('indexdirektur')->with('success', 'Data Berhasilsil Dihapus');
    }

    public function downloadFile($file)
{
    $filePath = storage_path('app/public/mou_files/' . $file);

    if (!file_exists($filePath)) {
        abort(404);
    }

    // Mendapatkan ekstensi file
    $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);

    // Menentukan MIME type berdasarkan ekstensi file
    $mimeType = mime_content_type($filePath);

    return response()->download($filePath, $file, ['Content-Type' => $mimeType]);
}
}