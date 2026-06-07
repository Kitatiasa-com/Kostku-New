<?php

namespace Database\Seeders;

use App\Models\Pembayaran;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PembayaranSeeder extends Seeder
{
    public function run(): void
    {
        $penghuni1 = User::where('role', 'penghuni')->where('email', 'penghuni1@coba.com')->first();
        $penghuni2 = User::where('role', 'penghuni')->where('email', 'penghuni2@coba.com')->first();

        if ($penghuni1) {
            Pembayaran::updateOrCreate([
                'id_pembayaran' =>'INV-' . strtoupper(Str::random(10)),
            ], [
                'user_id' => $penghuni1->id,
                'tanggal_pembayaran' => Carbon::now()->addDays(7)->format('Y-m-d'),
                'nominal' => 250000,
                'tipe_pembayaran' => 'cicilan',
                'jumlah_cicilan' => 2,
                'status' => 'belum_bayar',
                'snap_token' => null,
                'transaction_id' => null,
                'payment_type' => null,
                'paid_at' => null,
            ]);
        }

        if ($penghuni2) {
            Pembayaran::updateOrCreate([
                'id_pembayaran' => 'INV-' . strtoupper(Str::random(10)),
            ], [
                'user_id' => $penghuni2->id,
                'tanggal_pembayaran' => Carbon::now()->subDays(14)->format('Y-m-d'),
                'nominal' => 500000,
                'tipe_pembayaran' => 'lunas',
                'jumlah_cicilan' => 1,
                'status' => 'belum_bayar',
                'snap_token' => null,
                'transaction_id' => 'TRX-0003',
                'payment_type' => 'bank_transfer',
                'paid_at' => Carbon::now()->subDays(10),
            ]);
        }
    }
}
