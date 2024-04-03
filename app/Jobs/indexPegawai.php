<?php

namespace App\Jobs;

use App\Models\Pegawai;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class indexPegawai implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        $pegawai = Pegawai::all();

        foreach ($pegawai as $p) {
            Log::info($p);
        }
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
    }
}
