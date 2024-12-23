<?php 
  include('include/koneksi.php');
?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Uniwara Class - Lupa Password koordinator</title>
		<!-- Bootstrap -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
		<!-- Bootstrap Icons -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
		<!-- Data Tables -->
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap5.min.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
		<!-- Font Google -->
		<link rel="preko$koneksiect" href="https://fonts.googleapis.com">
		<link rel="preko$koneksiect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
		<!-- Data Icons -->
		<link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
		<!-- Own CSS -->
    	<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<!------------------------Proses Reset Password Admin-------------------->
		<?php
            if(isset($_POST['tambah'])){ 
                $email            = $_POST['email'];
                $pass1            = $_POST['password1'];
                $pass2            = $_POST['password2'];
                
                if($cek->num_rows == 0){
                    if($pass1 == $pass2){
                    $pass = md5($pass1); 
                    $insert = $koneksi->query("UPDATE koordinator SET password='$pass' WHERE email='$email'") or die(mysqli_error());
                        if($insert){ 
                            echo '<script language="javascript">alert("Selamat, Password Anda berhasil direset, Silahkan Login kembali!"); document.location="login-admin.php";</script>';
                        }else{ 
                            echo '<script language="javascript">alert("Upss, Password Anda gagal direset, Coba ulangi!!");</script>';
                        }
                    } else{ 
                        echo '<script language="javascript">alert("Password Tidak Sesuai!");</script>';
                    } 
                }else{ 
                    echo '<script language="javascript">alert("Email Tidak Sesuai!");</script>';
                }
            }else{
                echo '';
            }
		?>
        <div class="wrapper">
            <div class="main">
                <div class="container">
                    <div class="row my-2">
                        <div class="col-md">
                            <h4 class="fw-bold text-uppercase text-center">Akun</h4>
                        </div>
                        <hr>
                    </div>
                    <div class="row my-2">
                        <div class="col-md">
                            <form action="forgot-pass-user.php" method="post" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="text" name="email" id="email" class="form-control" placeholder="ex : example@gmail.com" required>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <input type="password" name="password1" id="password1" class="form-control" placeholder="ex : Example100%" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Ulangi Password</label>
                                        <input type="password" name="password2" id="password2" class="form-control" placeholder="Masukkan Password Sebelumnya" required>
                                    </div>
                                </div>
                                <a href="login-user.php" class="btn btn-danger" style="width: 100px;">Kembali</a>
                                <button type="reset" class="btn btn-secondary" style="width: 100px;">Batal</button>
                                <button type="submit" class="btn btn-warning" style="width: 100px;" name="tambah">Reset</button>
                            </form>
                        </div>
                    </div>
                    <footer class="text-center"><p>Copyright&copy;2024 - All Rights Reserved</p></footer>
                </div>
            </div>
        </div>
		<!-- Close Container -->

		<!-- Own JSS -->
		<script src="../js/script.js"></script>
		<!-- Bootstrap -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

		<!-- Data Tables -->
		<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
		<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap5.min.js"></script>
	</body>

</html>