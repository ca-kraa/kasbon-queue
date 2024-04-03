<?php

namespace App\Jobs;

use App\Models\Kasbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SetujuiKasbonJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $kasbons = Kasbon::whereNull('tanggal_disetujui')->get();
        foreach ($kasbons as $kasbon) {
            $kasbon->tanggal_disetujui = now();
            $kasbon->save();
        }
    }
}
