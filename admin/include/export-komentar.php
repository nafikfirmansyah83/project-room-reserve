<?php
// Memanggil atau membutuhkan file koneksi.php
include('../../include/koneksi.php');

// Menampilkan semua data dari table komentar berdasarkan id_komentar secara Descending
$komentar = query("SELECT * FROM komentar NATURAL JOIN koordinator ORDER BY id_komentar DESC");

// Membuat nama file
$date = date('d-m-Y');
$filename = "comment_data_$date.xls";

// Kodingam untuk export ke excel
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=\"$filename\"");

?>
<table class="text-center" border="1">
    <thead class="text-center">
        <tr>
            <th>No.</th>
			<th>Koordinator</th>
			<th>Ruangan</th>
            <th>Gedung</th>
			<th>Komentar</th>
			<th>Tanggal</th>
        </tr>
    </thead>
    <tbody class="text-center">
        <?php $no = 1; ?>
        <?php foreach ($komentar as $row) : ?>
            <tr>
            <td><?= $no++; ?></td>
			<td><?= $row['nama']; ?></td>
			<td><?= $row['ruangan']; ?></td>
            <td><?= $row['gedung']; ?></td>
			<td><?= $row['komentar']; ?></td>
			<td><?= $row['tanggal']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>