<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Download;
use App\Models\File;
use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function index()
    {
        $files = File::all();
        return view('admin.download', ['page' => 'download', 'files' => $files]);
    }

    public function store(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            $file->storeAs('public/file', $filename);

            File::create([
                ...$request->all(),
                'file' => $filename
            ]);

            return back()->with('success', 'Berhasil mengunggah file');
        } else {
            return back()->with('error', 'File diperlukan, harap unggah file');
        }
    }

    public function destroy($id)
    {
        try {
            File::where('id', $id)->delete();
            return back()->with('success', 'Berhasil menghapus file');
        } catch (\Throwable $th) {
            return back()->with('error', 'Gagal menghapus file');
        }
    }
}
