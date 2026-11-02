<?php

use App\Services\KuisSubmissionService;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('kuis:selesaikan-kedaluwarsa', function (KuisSubmissionService $submission) {
    $this->info($submission->selesaikanKedaluwarsa().' sesi kuis diselesaikan.');
})->purpose('Kumpulkan kuis yang waktunya habis, termasuk saat siswa menutup tab');

Schedule::command('kuis:selesaikan-kedaluwarsa')
    ->everyMinute()->withoutOverlapping();

// Auto-terbitkan kuis saat waktu_mulai tiba & kembalikan ke draft saat waktu_selesai lewat.
Schedule::command('kuis:auto-publish')
    ->everyMinute()->withoutOverlapping();
