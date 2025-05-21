<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Investment;
use App\Models\Package;
use App\Models\PackageInvestment;
use App\Models\User;
use Illuminate\Http\Request;

class PackageInvestmentController extends Controller
{
    public function index()
    {
        return view('admin.product.add-package-investment', ['page' => 'investment', 'packages' => Package::get()]);
    }

    public function requestInvestment()
    {
        $investment = Investment::with(['package', 'user'])->where('status', 'noactive')->get();

        return view('admin.product.request-investment', [
            'page' => 'investment',
            'investment' => $investment
        ]);
    }

    public function approveInvestment($id)
    {
        // Ambil investasi
        $investment = Investment::where('id', $id)->first();

        // Periksa apakah pengguna sudah membayar atau belum
        if ($investment->isPaid == 0) {
            return back()->with('error', 'Pengguna belum membayar');
        }

        // Ambil paket
        $package = Package::where('id', $investment->package_id)->first();

        // Variabel untuk menyimpan hari kadaluarsa
        $expiresDay = 0;

        // Ambil kontrak dan jadikan tipe angka
        $contract = intval($package->contract);
        // Periksa jenis estimasi profit
        switch ($package->estimasiProfit) {
            case 'Daily':
                $expiresDay = $contract; // Anggap $package->contract sudah dalam hari
                break;
            case 'Weekly':
                $expiresDay = $contract * 7; // Mengalikan jumlah minggu dengan 7 hari
                break;
            case 'Monthly':
                $expiresDay = $contract * 30; // Mengalikan jumlah bulan dengan 30 hari (ini adalah estimasi; Anda bisa menyesuaikan sesuai kebutuhan)
                break;
            default:
                $expiresDay = 0; // Atau bisa menjadi nilai default yang sesuai
                break;
        }

        // Simpan tanggal kadaluarsa yang ditentukan dari hari ini + hari kontrak
        $investment->expiresAt = now()->addDays($expiresDay);
        // Update status investasi menjadi aktif
        $investment->status = 'active';
        // Simpan
        $investment->save();

        return back()->with('success', 'Persetujuan berhasil');
    }

    public function store(Request $request)
    {
        Package::create($request->all());
        return back()->with('success', 'Paket investasi berhasil dibuat');
    }

    public function destroy(Request $request, $id)
    {
        try {
            $package = Package::where('id', $id)->delete();
            return back()->with('success', 'Hapus berhasil');
        } catch (\Throwable $e) {
            return back()->with('error', 'Hapus data gagal');
        }
    }
}
