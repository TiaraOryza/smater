<!DOCTYPE html>
<html>
<head>
	<title>Sistem Pendukung Keputusan Metode SMARTER</title>
</head>
<style>
    table {
        border-collapse: collapse;
    }
    table, th, td {
        border: 1px solid black;
    }
</style>
<body>
<h4>Hasil Akhir Perankingan</h4>
<table border="1" width="100%">
	<thead class="bg-success text-white">
        <tr align="center">
            <th>Nama Alternatif</th>
            <th>Nilai</th>
            <th width="15%">Ranking</th>
            <th width="15%">Tambahan Poin</th>
            <th width="15%">Poin Sekarang</th>
            <th width="15%">Level</th>
        </tr>
    </thead>
    <tbody>
        @php
            $no = 1;
        @endphp
        @foreach ($hasil as $keys)
        @php
        // Mengubah logika penambahan poin di blade
        $alt = $keys->nilai <= 0.5 ? 5 : 10;

        // Mengambil nilai poin sekarang dari database
        $poinSekarang = $keys->poin;

        // Menentukan level berdasarkan poin sekarang
        if ($poinSekarang > 100) {
            $level = 'Gold';
        } elseif ($poinSekarang > 80) {
            $level = 'Silver';
        } elseif ($poinSekarang > 40) {
            $level = 'Bronze';
        } else {
            $level = 'No Level';
        }
        @endphp
        <tr align="center">
            <td align="left">{{ $keys->nama }}</td>
            <td>{{ $keys->nilai }}</td>
            <td>{{ $no }}</td>
            <td>{{ $alt }}</td>
            <td>{{ $poinSekarang}}</td>
            <td>{{ $level }}</td>
        </tr>
        @php
            $no++;
        @endphp
        @endforeach
    </tbody>
</table>
<script>
	window.print();
</script>
</body>
</html>
