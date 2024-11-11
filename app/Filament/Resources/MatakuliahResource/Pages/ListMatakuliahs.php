<?php

namespace App\Filament\Resources\MatakuliahResource\Pages;

use App\Filament\Resources\MatakuliahResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMatakuliahs extends ListRecords
{
    protected static string $resource = MatakuliahResource::class;

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
    public static function cetakLaporan()
 {
 // Ambil data pengguna
 $data = \App\Models\matakuliah::all();
 // Load view untuk cetak PDF
 $pdf = \PDF::loadView('laporan.cetak', ['data' => $data]);
 // Unduh file PDF
 return response()->streamDownload(fn() => print($pdf->output()), 'laporanmatakuliah.pdf');
 }
}
