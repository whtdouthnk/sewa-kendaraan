<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        return view('petugas.laporan.index');
    }

    public function cetak(Request $request)
    {
        $request->validate([
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
        ]);

        $transaksi = Transaksi::with(['user', 'kendaraan', 'petugas'])
            ->whereBetween('tanggal_pinjam', [
                $request->tanggal_awal,
                $request->tanggal_akhir
            ])
            ->get();

        $totalPendapatan = $transaksi
            ->where('status_pembayaran', 'Lunas')
            ->sum('total_harga');

        return view('petugas.laporan.cetak', [
            'transaksi' => $transaksi,
            'tanggal_awal' => $request->tanggal_awal,
            'tanggal_akhir' => $request->tanggal_akhir,
            'totalPendapatan' => $totalPendapatan,
        ]);
    }
}