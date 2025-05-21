<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimoni;

class TestimoniController extends Controller
{
    public function index()
    {
        $testimoniTertunda = Testimoni::with('user')->where('status', 'pending')->get();
        return view('admin.testimoni.request-testimoni', [
            'page' => 'testimonial',
            'pendingTestimonials' => $testimoniTertunda
        ]);
    }

    public function update($id, $method)
    {
        $testimoni = Testimoni::find($id);
        $testimoni->status = $method;
        $testimoni->save();

        return back()->with('success', 'Update data berhasil');
    }
}
