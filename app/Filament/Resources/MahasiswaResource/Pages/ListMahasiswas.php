<?php

namespace App\Filament\Resources\MahasiswaResource\Pages;

use App\Filament\Resources\MahasiswaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMahasiswas extends ListRecords
{
    protected static string $resource = MahasiswaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(), // Tombol New
            Actions\Action::make('cetak_laporan')
            ->label('Cetak Laporan')
            ->icon('heroicon-o-printer')
            ->action(fn() => static::cetakLaporan())
            ->requiresConfirmation()
            ->modalHeading('Cetak Laporan Pengguna')
            ->modalSubheading('Apakah Anda yakin ingin mencetak laporan?'),
            ];
    }
    public static function cetakJlhMhs()
    {
        // Ambil data pengguna
     //   $data = DB\::raw(*SELECT jurusan, COUNT('studentID')JlhMhs FROM mahasiswa,);
        $data = \App\Models\mahasiswa::all();
        // Load view untuk cetak PDF
        $pdf = \PDF::loadView('laporan.cetak.JlhMahasiswa', ['data' => $data]);
        // Unduh file PDF
        return response()->streamDownload(fn() => print($pdf->output()), 'laporanmatakuliah.pdf');
        }
}
