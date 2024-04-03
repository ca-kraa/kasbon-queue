<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PegawaiRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;



class PegawaiController extends Controller
{
    protected $pegawaiRepository;

    public function __construct(PegawaiRepository $pegawaiRepository)
    {
        $this->pegawaiRepository = $pegawaiRepository;
    }

    public function indexPegawai()
    {
        $pegawais = $this->pegawaiRepository->all();

        $pegawais = $pegawais->map(function ($pegawai) {
            $nama = strtoupper(explode(' ', $pegawai->nama)[0]);
            $tanggal_masuk = date('d/m/Y', strtotime($pegawai->tanggal_masuk));
            $total_gaji = number_format($pegawai->total_gaji, 0, ',', '.');

            return [
                'nama' => $nama,
                'tanggal_masuk' => $tanggal_masuk,
                'total_gaji' => $total_gaji
            ];
        });

        return response()->json($pegawais);
    }

    public function createPegawai(Request $request)
    {
        try {
            $request->validate([
                'nama' => 'required|max:10|unique:pegawais',
                'tanggal_masuk' => 'required|date|before_or_equal:today',
                'total_gaji' => 'required|numeric',
            ]);

            $data = [
                'nama' => $request->nama,
                'tanggal_masuk' => $request->tanggal_masuk,
                'total_gaji' => $request->total_gaji,
            ];

            $this->pegawaiRepository->create($data);

            return response()->json(['message' => 'Data pegawai berhasil ditambahkan', 'data' => $data]);
        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->toArray();
            $errorMessage = [];
            foreach ($errors as $key => $value) {
                $errorMessage[] = implode(', ', $value);
            }

            return response()->json(['message' => 'Terjadi kesalahan saat validasi data', 'errors' => $errorMessage], 422);
        } catch (\Exception $e) {
            Log::error('Error creating pegawai: ' . $e->getMessage());

            return response()->json(['message' => 'Terjadi kesalahan saat menambahkan data pegawai'], 500);
        }
    }
}
