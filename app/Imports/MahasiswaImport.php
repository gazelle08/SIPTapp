<?php
namespace App\Imports;
use App\Models\Mahasiswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class MahasiswaImport implements ToModel, WithHeadingRow
{
 public function model(array $row)
 {
 return new Mahasiswa([
 'nama' => $row['nama'], // Sesuaikan field dengan kolom di Excel
 'nim' => $row['nim'],
 'jurusan' => $row['jurusan'],
 // tambahkan field lainnya
 ]);
 }
}