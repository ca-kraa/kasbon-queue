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
        $kasbons = $this->kasbonRepository->all();

        return response()->json($kasbons);
    }
}
