<?php

namespace App\Jobs;

use App\Repositories\PegawaiRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class indexPegawai implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $pegawaiRepository;

    /**
     * Create a new job instance.
     *
     * @param PegawaiRepository $pegawaiRepository
     */
    public function __construct(PegawaiRepository $pegawaiRepository)
    {
        $this->pegawaiRepository = $pegawaiRepository;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // $pegawai = $this->pegawaiRepository->getAll();

        // foreach ($pegawai as $p) {
        //     Log::info($p);
        // }
    }
}
