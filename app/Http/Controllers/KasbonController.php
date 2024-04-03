<?php

namespace App\Http\Controllers;

use App\Models\Kasbon;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Repositories\KasbonRepository;
use Illuminate\Validation\ValidationException;

class KasbonController extends Controller
{
    protected $kasbonRepository;

    public function __construct(KasbonRepository $kasbonRepository)
    {
        $this->kasbonRepository = $kasbonRepository;
    }

    public function indexKasbon(Request $request)
    {
        $kasbons = $this->kasbonRepository->all();

        $kasbons = $kasbons->map(function ($kasbon) {
            $tanggal_diajukan = \Carbon\Carbon::parse($kasbon->tanggal_diajukan)->format('Y-M');
            $tanggal_disetujui = $kasbon->tanggal_disetujui === null ? 1 : \Carbon\Carbon::parse($kasbon->tanggal_disetujui)->format('Y-M');

            return [
                'tanggal_diajukan' => $tanggal_diajukan,
                'tanggal_disetujui' => $tanggal_disetujui,
                'pegawai_id' => $kasbon->pegawai_id,
                'total_kasbon' => $kasbon->total_kasbon,
            ];
        });

        return response()->json($kasbons);
    }

    public function createKasbon(Request $request)
    {
        try {
            $request->validate([
                'pegawai_id' => [
                    'required',
                    'numeric',
                    function ($attribute, $value, $fail) use ($request) {
                        $pegawai = Pegawai::find($value);
                        if (!$pegawai) {
                            return $fail('Pegawai tidak ditemukan.');
                        }

                        $totalKasbon = $request->total_kasbon;
                        $totalGaji = $pegawai->total_gaji;
                        if ($totalKasbon > ($totalGaji * 0.5)) {
                            return $fail('Total kasbon tidak boleh lebih dari 50% dari total gaji pegawai.');
                        }
                    }
                ],
                'total_kasbon' => 'required|numeric',
            ]);

            $data = [
                'pegawai_id' => $request->pegawai_id,
                'total_kasbon' => $request->total_kasbon,
            ];

            $this->kasbonRepository->create($data);

            $newKasbon = Kasbon::latest()->first();

            return response()->json(['message' => 'Data kasbon berhasil ditambahkan', 'data' => $newKasbon]);
        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->toArray();
            $errorMessage = [];
            foreach ($errors as $key => $value) {
                $errorMessage[] = implode(', ', $value);
            }

            return response()->json(['message' => 'Terjadi kesalahan saat validasi data', 'errors' => $errorMessage], 422);
        } catch (\Exception $e) {
            Log::error('Error creating kasbon: ' . $e->getMessage());

            return response()->json(['message' => 'Terjadi kesalahan saat menambahkan data kasbon'], 500);
        }
    }

    public function setujuiKasbon($id)
    {
        try {
            $kasbon = Kasbon::findOrFail($id);

            if ($kasbon->tanggal_disetujui !== null) {
                return response()->json(['message' => 'Kasbon dengan ID tersebut sudah disetujui'], 400);
            }

            $kasbon->tanggal_disetujui = now();
            $kasbon->save();

            return response()->json(['message' => 'Kasbon berhasil disetujui', 'data' => $kasbon]);
        } catch (\Exception $e) {
            Log::error('Error approving kasbon: ' . $e->getMessage());
            return response()->json(['message' => 'Terjadi kesalahan saat menyetujui kasbon'], 500);
        }
    }

    public function setujuiMasal()
    {
        try {
            $totalPengajuan = $this->kasbonRepository->setujuiMasal();

            return response()->json(['message' => 'Berhasil menyetujui kasbon masal', 'total' => $totalPengajuan]);
        } catch (\Exception $e) {
            Log::error('Error setujui masal kasbon: ' . $e->getMessage());

            return response()->json(['message' => 'Terjadi kesalahan saat menyetujui kasbon masal'], 500);
        }
    }
}
