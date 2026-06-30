<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\PengajuanSurat;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('layouts.mahasiswa', function ($view) {

            $jumlahNotifikasi = 0;

            if (Auth::check() && Auth::user()->role == 'mahasiswa') {

                $mahasiswa = Auth::user()->mahasiswa;

                $jumlahNotifikasi = PengajuanSurat::where(
                    'mahasiswa_id',
                    $mahasiswa->id
                )
                ->whereIn('status', [
                    'menunggu_verifikasi',
                    'diteruskan_ke_kaprodi'
                ])
                ->count();
            }

            $view->with('jumlahNotifikasi', $jumlahNotifikasi);

        });

        View::composer('layouts.admin', function ($view) {

                $jumlahPengajuanBaru = PengajuanSurat::where('status', 'menunggu_verifikasi')
                    ->count();

                $view->with('jumlahPengajuanBaru', $jumlahPengajuanBaru);
            });
        
    }
}