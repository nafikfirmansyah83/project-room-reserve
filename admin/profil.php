<?php 
    include('../include/koneksi.php');
    include("include/akses admin.php");
    
    $email = $_SESSION['email']; 
    $cek = $koneksi->query("select*from user where email='$email'"); 
        if($cek->num_rows == 0){
            header("Location:../index admin.php");
        }else{
            $row = $cek->fetch_assoc();
        }
    $nama = $row['nama'];
?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Uniwara Class - Profil <?php echo (strtoupper($row['nama'])); ?></title>
		<!-- Bootstrap -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
		<!-- Bootstrap Icons -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
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
                <main class="content px-3 py-4">
                    <div class="container">
                        <div class="row my-2">
                            <div class="col-md">
                                <h3 class="fw-bold text-uppercase">Profil Admin</h3>
                                <hr>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-md">
                                <table id="data" class="table table-borderless table-responsive " style="width:100%">
                                    
                                        <?php   
                                            $cek=$koneksi->query("SELECT * FROM user where email='$email'"); 
                                            if($cek->num_rows == 0){
                                                echo '
                                                <tr>
                                                    <td>Tidak ada data saat ini...</center></td>
                                                </tr>';
                                            }else{
                                                $no=1;
                                                while($erow = $cek->fetch_assoc()) {
                                                        extract($erow)
                                        ?>
                                        <?php
                                                echo '
                                                    <tr>
                                                        <td colspan="2">
                                                        </td>
                                                        <td>
                                                            <img src="../foto/'.$erow['foto'].'" width="140px" height="140px">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="210px"><b>Nama</b></td>
                                                        <td>:</td>
                                                        <td>'.$erow['nama'].'</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Email</b></td>
                                                        <td>:</td>
                                                        <td>'.$erow['email'].'</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Jabatan</b></td>
                                                        <td>:</td>
                                                        <td>'.$erow['jabatan'].'</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Tempat, Tanggal Lahir</b></td>
                                                        <td>:</td>
                                                        <td>'.$erow['tempat_lahir'].', '.$erow['tanggal_lahir'].'</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Jenis Kelamin</b></td>
                                                        <td>:</td>
                                                        <td>'.$erow['jenis_kelamin'].'</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan=2>
                                                        </td>
                                                        <td>
                                                            <a href="profil edit.php?id_user='.$erow['id_user'].'" class="align-right">Edit Profil</a> | 
                                                            <a href="password ganti.php?id_user='.$erow['id_user'].'" class="align-left">Ganti Password</a>
                                                        </td>
                                                    </tr>';
                                                $no++;
                                                }
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <footer class="text-center"><p>Copyright&copy;2024 - All Rights Reserved</p></footer>	
                </div>
            </div>
		</div>
		<!-- Own JSS -->
		<script src="../js/script.js"></script>
		<!-- Bootstrap -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
	</body>
</html>