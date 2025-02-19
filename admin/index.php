<?php 
    include('../include/koneksi.php');
    include("include/akses admin.php");
    
    $data_kosong = mysqli_query($koneksi,"SELECT * FROM ruangan WHERE kondisi='KOSONG'");
    $data_menunggu = mysqli_query($koneksi,"SELECT * FROM ruangan WHERE kondisi='MENUNGGU'");
    $data_terisi = mysqli_query($koneksi,"SELECT * FROM ruangan WHERE kondisi='TERISI'");

    $jumlah_kosong = mysqli_num_rows($data_kosong);
    $jumlah_menunggu = mysqli_num_rows($data_menunggu);
    $jumlah_terisi = mysqli_num_rows($data_terisi);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Uniwara Class - Dashboard Admin</title>
        <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
                    <div class="container-fluid">
                        <div class="mb-3">
                            <h3 class="fw-bold fs-4 mb-3">Admin Dashboard</h3>
                            <div class="row">
                                <div class="col-12 col-md-4 ">
                                    <div class="card border-0">
                                        <div class="card-body py-4">
                                            <h5 class="mb-2 fw-bold">
                                                Jumlah Kelas Terpakai
                                            </h5>
                                            <p class="mb-2 fs-1 fw-bold text-danger">
                                                <?php echo $jumlah_terisi; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 ">
                                    <div class="card  border-0">
                                        <div class="card-body py-4">
                                            <h5 class="mb-2 fw-bold">
                                                Jumlah Kelas Tersedia
                                            </h5>
                                            <p class="mb-2 fs-1 fw-bold text-success">
                                                <?php echo $jumlah_kosong; ?>
                                            </p>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 ">
                                    <div class="card border-0">
                                        <div class="card-body py-4">
                                            <h5 class="mb-2 fw-bold">
                                                Menunggu Persetujuan 
                                            </h5>
                                            <p class="mb-2 fs-1 fw-bold text-warning">
                                                <?php echo $jumlah_menunggu; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="text-center"><p>Copyright&copy;2024 - All Rights Reserved</p></footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="../js/script.js"></script>
    </body>
</html>