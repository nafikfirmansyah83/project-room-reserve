<?php 
	include('../include/koneksi.php');
	include("include/akses admin.php"); 
?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Uniwara Class - Ganti Password</title>
		<!-- Bootstrap -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
		<!-- Font Google -->
		<link rel="prekone$koneksiect" href="https://fonts.googleapis.com">
		<link rel="prekone$koneksiect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
		<!-- Own CSS -->
    	<link rel="stylesheet" href="../css/style.css">
	</head>
	<body>
		<?php
			$email = $_SESSION['email']; // mengambil username dari session yang login
		
			$cek = $koneksi->query("select*from user where email='$email'"); // query memilih entri username pada database
			if($cek->num_rows == 0){
				header("Location:../index.php");
			}else{
			$row = $cek->fetch_assoc();
			$email = $row['email'];
			}
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$username = $_POST['email'];
			$current_password = $_POST['passwordLama'];
			$new_password = $_POST['passwordBaru'];
			$confirm_password = $_POST['passwordUlang'];
			if ($new_password != $confirm_password) {
				echo '<script language="javascript">alert("Password Baru dan Konfirmasi Password tidak Sesuai!");</script>';
			}
			
			$username = $koneksi->real_escape_string($username);
			$current_password = $koneksi->real_escape_string($current_password);
			$new_password = $koneksi->real_escape_string($new_password);

			// Hash passwords using MD5
			$current_password_hashed = md5($current_password);
			$new_password_hashed = md5($new_password);
			
			// Query untuk mengambil password berdasarkan username
			$sql = "SELECT password FROM user WHERE email = '$username'";
			$result = $koneksi->query($sql);
			
			if ($result->num_rows > 0) {
				$row = $result->fetch_assoc();
				$hashed_password = $row['password'];
			
				if (md5($current_password) == $hashed_password) {
					$new_hashed_password = md5($new_password);
			
					// Query untuk mengupdate password
					$update_sql = "UPDATE user SET password = '$new_hashed_password' WHERE email = '$username'";
					if ($koneksi->query($update_sql) === TRUE) {
						echo '<script language="javascript">alert("Berhasil mengubah Password!"); document.location="profil.php";</script>';
					} else {
						echo '<script language="javascript">alert("Gagal mengubah Password!");</script>';
					}
				} else {
					echo '<script language="javascript">alert("Password Lama Salah!");</script>';
				}
			} else {
				echo '<script language="javascript">alert("Email Tidak ditemukan!");</script>';
			}
			
			$koneksi->close();
			}
		?>
		<div class="main">
			<main class="content px-3 py-4">
				<div class="container">
					<div class="row my-2">
						<div class="col-md">
							<h3 class="fw-bold text-uppercase">Ubah Password</h3>
						</div>
						<hr>
					</div>
					<div class="row my-2">
						<div class="col-md">
							<form action="password ganti.php" method="post" enctype="multipart/form-data">
							<div class="mb-3">
								<label class="form-label">Email</label>
								<input type="text" name="email" id="email" value="<?php echo $email ?>" class="form-control" required readonly>
							</div>
							<div class="mb-3">
								<label class="form-label">Password Lama</label>
								<input type="password" name="passwordLama" id="passwordLama" class="form-control" required>
							</div>
							<div class="mb-3">
								<label class="form-label">Password Baru</label>
								<input type="password" name="passwordBaru" id="passwordBaru" class="form-control" required>
							</div>
							<div class="mb-3">
								<label class="form-label">Ulangi Password Baru</label>
								<input type="password" name="passwordUlang" id="passwordUlang" class="form-control" required>
							</div>
							<a href="profil.php?email=<?= $email ?>" class="btn btn-danger" style="width: 100px;">Kembali</a>
							<button type="reset" class="btn btn-secondary" style="width: 100px;">Batal</button>
							<button type="submit" class="btn btn-warning" style="width: 100px;" name="simpan">Ubah</button>
							</form>
						</div>
					</div>
					<footer class="text-center"><p>Copyright&copy;2024 - All Rights Reserved</p></footer>
				</div>
			</main>	
		</div>	
		<!-- Close Container -->

		<!-- Own JSS -->
		<script src="../js/script.js"></script>
		<!-- Bootstrap -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
	</body>
</html>