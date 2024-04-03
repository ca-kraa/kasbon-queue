<?php

namespace App\Console\Commands;

use App\Models\Kasbon;
use App\Jobs\SetujuiKasbonJob;
use Illuminate\Console\Command;

class SetujuiKasbon extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:setujui-kasbon';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        SetujuiKasbonJob::dispatch();
        $this->info('Kasbon berhasil disetujui.');
    }
}
