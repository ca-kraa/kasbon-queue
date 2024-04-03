<?php

namespace App\Console\Commands;

use App\Jobs\indexPegawai;
use Illuminate\Console\Command;

class TampilkanPegawai extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:tampilkan-pegawai';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        indexPegawai::dispatch()->onQueue('data-pegawai');
        $this->info('Menampilkan data pegawai...');
    }
}
