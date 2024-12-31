<?php
// Memanggil atau membutuhkan file koneksi.php
include('../../include/koneksi.php');

// Menampilkan semua data dari table ruangan berdasarkan id_ruangan secara Descending
$ruangan = query("SELECT * FROM ruangan NATURAL JOIN fakultas NATURAL JOIN prodi ORDER BY id_ruangan DESC");

// Membuat nama file
$date = date('d-m-Y');
$filename = "exported_data_$date.xls";

// Kodingam untuk export ke excel
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=\"$filename\"");

?>
<table class="text-center" border="1">
    <thead class="text-center">
        <tr>
            <th>No.</th>
            <th>Hari</th>
            <th>Jam</th>
            <th>Ruangan</th>
            <th>Gedung</th>
            <th>Mata Kuilah</th>
            <th>Fakultas</th>
            <th>Prodi</th>
            <th>Kondisi</th>
            <th>Catatan</th>
        </tr>
    </thead>
    <tbody class="text-center">
        <?php $no = 1; ?>
        <?php foreach ($ruangan as $row) : ?>
            <tr>
                <td><?= $no++; ?></td>
				<td><?= $row['hari']; ?></td>
				<td><?= $row['jam']; ?></td>
				<td><?= $row['ruangan']; ?></td>
				<td><?= $row['gedung']; ?></td>
				<td><?= $row['matkul']; ?></td>
				<td><?= $row['fakultas']; ?></td>
				<td><?= $row['prodi']; ?></td>
				<td><?= $row['kondisi']; ?></td>
				<td><?= $row['catatan']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>