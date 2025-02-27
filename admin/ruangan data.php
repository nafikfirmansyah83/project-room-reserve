<?php 
    include('../include/koneksi.php');
    include('include/akses admin.php'); 

    // Menampilkan semua data dari table siswa berdasarkan nis secara Ascending
    $ruangan = query("SELECT * FROM ruangan natural join fakultas natural join prodi ORDER BY id_ruangan ASC");
?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Uniwara Class - Data Ruangan</title>
		<!-- Bootstrap -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
		<!-- Bootstrap Icons -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
		<!-- Data Tables -->
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap5.min.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
		<!-- Font Google -->
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
		<!-- Data Icons -->
		<link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
		<!-- Own CSS -->
    	<link rel="stylesheet" href="../css/style.css">
	</head>
	<body>
		<?php
            $email = $_SESSION['email']; 
        
            $cek = $koneksi->query("select*from user where email='$email'"); 
            if($cek->num_rows == 0){
                header("Location:../index admin.php");
            }else{
            $row = $cek->fetch_assoc();
            }

            $nama = $row['nama'];
        ?>
		<div class="wrapper">
            <aside id="sidebar">
                <div class="d-flex">
                    <button class="toggle-btn" type="button">
                        <i class="lni lni-grid-alt"></i>
                    </button>
                    <div class="sidebar-logo">
                        <a href="index.php">Uniwara</a>
                    </div>
                </div>
                <ul class="sidebar-nav">
                <li class="sidebar-item">
                        <a href="profil.php?nama=<?= $row['nama']; ?>" class="sidebar-link">
                            <i class="lni lni-user"></i>
                            <span>Profil</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="Konfirmasi.php" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                            data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                            <i class="lni lni-apartment"></i>
                            <span>Ruangan</span>
                        </a>
                        <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="ruangan data.php" class="sidebar-link">Data</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="Konfirmasi ruangan.php" class="sidebar-link">Pesanan</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a href="koordinator data.php" class="sidebar-link">
                            <i class="lni lni-license"></i>
                            <span>Koordinator</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="Konfirmasi.php" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                            data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                            <i class="lni lni-protection"></i>
                            <span>Konfirmasi</span>
                        </a>
                        <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="akun.php" class="sidebar-link">Akun Koordinator</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="admin.php" class="sidebar-link">Akun Admin</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a href="komentar.php" class="sidebar-link">
                            <i class="lni lni-popup"></i>
                            <span>Komentar</span>
                        </a>
                    </li>
                </ul>
                <div class="sidebar-footer">
                    <a href="../logout.php" class="sidebar-link">
                        <i class="lni lni-exit"></i>
                        <span>Logout</span>
                    </a>
                </div>
            </aside>
            <?php
                if(isset($_GET['aksi']) == 'delete'){ 
                    $id_ruangan = $_GET['id_ruangan']; 
                    $cek=$koneksi->query("select*from ruangan where id_ruangan='$id_ruangan'"); 
                    if($cek->num_rows == 0){ 
                    $pesan = ''; 
                    }else{
                        $delete=$koneksi->query("delete from ruangan where id_ruangan='$id_ruangan'");
                        if($delete){
                            echo '<script language="javascript">alert("Berhasil menghapus Ruangan!"); document.location="ruangan data.php";</script>';
                        }else{ 
                            echo '<script language="javascript">alert("Gagal menghapus Ruangan!"); document.location="ruangan data.php";</script>';
                        }
                    }
                }else{
                    echo '';
                }
            ?>
            <div class="main">
                <nav class="navbar navbar-expand px-4 py-3">
                    <form action="#" class="d-none d-sm-inline-block">

                    </form>
                    <div class="navbar-collapse collapse">
                        <ul class="navbar-nav ms-auto">
                            <div class="card-body py-2">
                                <p class="fw-bold me-2">
                                    <a href="profil.php?nama=<?= $row['nama']; ?>"><?php echo (strtoupper($row['nama'])); ?></a>
                                </p>
                            </div>
                            <li class="nav-item dropdown">
                                <img src="https://student.wiraakademik.uniwara.ac.id:8083/images/logo.png" class="avatar img-fluid" alt="">
                            </li>
                        </ul>
                    </div>
                </nav>
                <main class="content px-3 py-4">
                    <div class="container">
                        <div class="row my-2">
                            <div class="col-md">
                                <h3 class="fw-bold text-uppercase">Data Ruangan</h3>
                                <hr>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-md">
                                <a href="ruangan tambah.php" class="btn btn-primary justify-content-end"><i class="bi bi-person-plus-fill"></i>&nbsp;Tambah Data</a>
                                <a href="include/export-ruangan.php" target="_blank" class="btn btn-success ms-1 justify-content-end"><i class="bi bi-file-earmark-spreadsheet-fill"></i>&nbsp;Ekspor ke Excel</a>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-md table-wrapper">
                                <table id="data" class="table table-striped table-responsive-xxl table-hover text-center" style="width:100%">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>No.</th>
                                            <th>Hari</th>
                                            <th>Jam</th>
                                            <th>Ruangan</th>
                                            <th>Mata Kuilah</th>
                                            <th>Fakultas</th>
                                            <th>Prodi</th>
                                            <th>Kondisi</th>
                                            <th>Catatan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        <?php foreach ($ruangan as $row) : ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $row['hari']; ?></td>
                                                <td><?= $row['jam']; ?></td>
                                                <td><?= $row['ruangan']; ?></td>
                                                <td><?= $row['matkul']; ?></td>
                                                <td><?= $row['fakultas']; ?></td>
                                                <td><?= $row['prodi']; ?></td>
                                                <td><?= $row['kondisi']; ?></td>
                                                <td><?= $row['catatan']; ?></td>
                                                <td>
                                                    <a href="ruangan edit.php?id_ruangan=<?= $row['id_ruangan']; ?>" class="btn btn-warning btn-sm" style="font-weight: 600; width: 85px;"><i class="bi bi-pencil-square"></i>&nbsp;Ubah</a> | 
                                                    <a href="ruangan data.php?aksi=delete&id_ruangan=<?= $row['id_ruangan']; ?>" class="btn btn-danger btn-sm" style="font-weight: 600; width: 85px;" onclick="return confirm('Apakah anda yakin ingin menghapus data <?= $row['ruangan']; ?> ?');"><i class="bi bi-trash-fill"></i>&nbsp;Hapus</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <footer class="text-center"><p>Copyright&copy;2024 - All Rights Reserved</p></footer>	
                </main>
            </div>        
		</div>
		<!-- Own JSS -->
		<script src="../js/script.js"></script>
		<!-- Bootstrap -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

		<!-- Data Tables -->
		<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
		<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap5.min.js"></script>

		<script>
        $(document).ready(function() {
            // Fungsi Table
            $('#data').DataTable();
            // Fungsi Table
        });
        </script>
	</body>
</html>