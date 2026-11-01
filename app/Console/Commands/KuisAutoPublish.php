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

        /*
         * 1. Auto-terbit: kuis yang status_publikasi = draft,
         *    waktu_mulai sudah tiba (<=now), waktu_selesai belum lewat (>now).
         */
        $diterbitkan = Kuis::where('status_publikasi', 'draft')
            ->whereNotNull('waktu_mulai')
            ->whereNotNull('waktu_selesai')
            ->where('waktu_mulai', '<=', $now)
            ->where('waktu_selesai', '>', $now)
            ->where('is_aktif', true)
            ->get();

        foreach ($diterbitkan as $kuis) {
            $kuis->update([
                'status_publikasi' => 'terbit',
            ]);
            $this->info("Terbit: [{$kuis->id_kuis}] {$kuis->judul}");
        }

        /*
         * 2. Auto-draft: kuis yang status_publikasi = terbit,
         *    waktu_selesai sudah lewat (<=now).
         */
        $dikembalikan = Kuis::where('status_publikasi', 'terbit')
            ->whereNotNull('waktu_selesai')
            ->where('waktu_selesai', '<=', $now)
            ->where('is_aktif', true)
            ->get();

        foreach ($dikembalikan as $kuis) {
            $kuis->update([
                'status_publikasi' => 'draft',
                'id_publisher'     => null,
            ]);
            $this->info("Draft kembali: [{$kuis->id_kuis}] {$kuis->judul}");
        }

        $total = $diterbitkan->count() + $dikembalikan->count();
        $this->line("Selesai. {$diterbitkan->count()} diterbitkan, {$dikembalikan->count()} dikembalikan ke draft.");

        return self::SUCCESS;
    }
}
