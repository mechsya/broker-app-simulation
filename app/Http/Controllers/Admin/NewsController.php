<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::all();
        return view('admin.news', ['page' => 'news', 'news' => $news]);
    }

    public function store(Request $request)
    {
        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $filename = $file->getClientOriginalName();
            $file->storeAs('public/cover', $filename);

            News::create([
                ...$request->all(),
                'cover' => $filename,
            ]);

            return back()->with('success', 'Berita berhasil diunggah');
        } else {
            return back()->with('error', 'File diperlukan, silakan unggah file');
        }
    }

    public function destroy($id)
    {
        News::where('id', $id)->delete();
        return back()->with('success', 'Data berhasil dihapus');
    }
}
