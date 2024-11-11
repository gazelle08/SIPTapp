<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Laporan Mahasiswa</title>
<style>
body { font-family: Arial, sans-serif; }
table { width: 100%; border-collapse: collapse; }
th, td { padding: 8px; text-align: left; border: 1px solid #ddd; }
</style>
</head>
<body>
<h2>Laporan Mahasiswa</h2>
<table>
<thead>
<tr>
<th>studentID</th>
<th>Nama</th>
<th>Jurusan</th>
<th>Tahun Masuk</th>
</tr>
</thead>
<tbody>
@foreach($data as $mahasiswa)
<tr>
<td>{{ $mahasiswa->jurusan}}</td>
<td>{{ $mahasiswa->Jlhmhs }}</td>

</tr>
@endforeach
</tbody>
</table>
</body>
</html>