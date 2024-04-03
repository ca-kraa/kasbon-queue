<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\KasbonRepository;

class KasbonController extends Controller
{
    protected $kasbonRepository;

    public function __construct(KasbonRepository $kasbonRepository)
    {
        $this->kasbonRepository = $kasbonRepository;
    }

    public function indexKasbon(Request $request)
    {
        $query = $this->kasbonRepository->query();

        // Filter berdasarkan bulan
        if ($request->has('bulan')) {
            $bulan = $request->bulan;
            $query->whereRaw("DATE_FORMAT(tanggal_diajukan, '%Y-%m') = ?", [$bulan]);
        }

        // Filter berdasarkan status persetujuan
        if ($request->has('belum_disetujui')) {
            $belumDisetujui = $request->belum_disetujui;
            $query->where('status_persetujuan', $belumDisetujui);
        }

        // Filter berdasarkan tanggal disetujui
        if ($request->has('tanggal_disetujui')) {
            $query->whereNull('tanggal_disetujui');
        }

        $kasbons = $query->get();

        return response()->json($kasbons);
    }
}
