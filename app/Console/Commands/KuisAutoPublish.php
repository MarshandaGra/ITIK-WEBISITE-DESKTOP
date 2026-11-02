<?php

namespace App\Console\Commands;

use App\Models\Kuis;
use Carbon\Carbon;
use Illuminate\Console\Command;

class KuisAutoPublish extends Command
{
    /**
     * Nama signature command artisan.
     */
    protected $signature = 'kuis:auto-publish';

    /**
     * Deskripsi command.
     */
    protected $description = 'Terbitkan kuis yang waktu_mulainya sudah tiba, dan kembalikan ke draft jika waktu_selesainya sudah lewat.';

    public function handle(): int
    {
        $now = Carbon::now();

        Kuis::sinkronisasiStatus($now);

        $this->line("Sinkronisasi jadwal kuis selesai pada {$now->toDateTimeString()}.");

        return self::SUCCESS;
    }
}
