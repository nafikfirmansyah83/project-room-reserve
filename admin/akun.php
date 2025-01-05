<?php 
    include('../include/koneksi.php');
    include("include/akses admin.php"); 

    // Menampilkan semua data dari table 
    $akun_koordinator = query("SELECT * FROM koordinator natural join prodi WHERE status='non aktif'");
?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Uniwara Class - Konfirmasi Akun Koordinator</title>
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
            <div class="main">
                <nav class="navbar navbar-expand px-4 py-3">
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
                                <h3 class="fw-bold text-uppercase">Konfirmasi Akun Koordinator</h3>
                                <hr>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-md table-wrapper">
                                <table id="data" class="table table-striped table-responsive-xxl table-hover text-center" style="width:100%">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>No.</th>
                                            <th>NIM</th>
                                            <th>Nama</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Prodi</th>
                                            <th>Angkatan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $no = 1; 
                                            foreach ($akun_koordinator as $row) : 
                                        ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $row['nim']; ?></td>
                                                <td><?= $row['nama']; ?></td>
                                                <td><?= $row['jenis_kelamin']; ?></td>
                                                <td><?= $row['prodi']; ?></td>
                                                <td><?= $row['angkatan']; ?></td>
                                                <td> 
                                                    <a href="akun.php?aksi=aktif-koordinator&id_koordinator=<?= $row['id_koordinator']; ?>" class="btn btn-success btn-sm" style="font-weight: 600;" onclick="return confirm('Apakah anda yakin ingin mengaktifkan akun <?= $row['nama']; ?> ?');"><i class="bi bi-person-fill-check"></i>&nbsp;Terima</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php
                        if(isset($_GET['aksi']) == 'aktif-koordinator'){
                            $id_koordinator = $_GET['id_koordinator']; 
                            $cek=$koneksi->query("SELECT * FROM koordinator WHERE id_koordinator='$id_koordinator'"); 
                            if($cek->num_rows == 0){ 
                            $pesan = '';
                            }else{
                                $insert = $koneksi->query("update koordinator set status='aktif' where id_koordinator='$id_koordinator'") or die(mysqli_error());
                                if($insert){
                                    echo '<script language="javascript">alert("Data berhasil diaktifkan!"); document.location="akun.php";</script>';
                                }else{ 
                                    echo '<script language="javascript">alert("Data gagal diaktifkan!"); document.location="akun.php";</script>';
                                }
                            }
                        }else{
                            $pesan = '';
                        }
                        ?>
    			    </div>
                </main>    
                <footer class="text-center"><p>Copyright&copy;2024 - All Rights Reserved</p></footer>	
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