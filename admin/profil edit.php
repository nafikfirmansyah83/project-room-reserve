<?php 
	include('../include/koneksi.php');
	include("include/akses admin.php");
?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Uniwara Class - Edit Profil</title>
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

			$id_user = $_GET['id_user']; 
			$cek = $koneksi->query("SELECT * FROM user WHERE id_user='$id_user'"); 
			if($cek->num_rows == 0){
				echo "";
			}else{
				$erow = $cek->fetch_assoc();
			}
			if(isset($_POST['simpan'])){ 
				$nama   		= $_POST['nama'];
				$jabatan   		= $_POST['jabatan'];
				$jenis_kelamin  = $_POST['jenis_kelamin'];
				$tempat_lahir   = $_POST['tempat_lahir'];
				$tanggal_lahir  = $_POST['tanggal_lahir'];
				$gambarLama 	= $_POST['gambarLama'];

				if ($_FILES['gambar']['error'] === 4) {
					$gambar = $gambarLama;
				} else {
					$gambar = upload();
				}
				$update = $koneksi->query("UPDATE user SET 
										nama='$nama',
										jabatan='$jabatan',
										jenis_kelamin='$jenis_kelamin',
										tempat_lahir='$tempat_lahir',
										tanggal_lahir='$tanggal_lahir',
										foto='$gambar'
										WHERE id_user='$id_user'") or die(mysqli_error()); 
				if($update){ 
					echo '<script language="javascript">alert("Berhasil mengubah Profil!"); document.location="profil.php";</script>';
				}else{ 
					echo '<script language="javascript">alert("Gagal mengubah Profil!");</script>'; 
				}
			}else{
				echo '';
			}
		?>
		<div class="container">
			<div class="row my-2">
				<div class="col-md">
					<h3 class="fw-bold text-uppercase">Ubah Data Profil</h3>
					<hr>
				</div>
			</div>
			<div class="row my-2">
				<div class="col-md">
					<form action="" method="post" enctype="multipart/form-data">
						<div class="mb-3">
							<label class="form-label">Nama</label>
							<input type="hidden" name="gambarLama" value="<?php echo $erow['foto']; ?>">
							<input type="text" name="nama" id="nama" class="form-control" value="<?php echo $erow['nama']; ?>" autocomplete="off" required>
						</div>
						<div class="mb-3">
							<label class="form-label">Email</label>
							<input type="text" name="email" id="email" class="form-control" value="<?php echo $erow['email']; ?>" autocomplete="off" required>
						</div>
						<div class="mb-3">
							<label class="form-label">Jabatan</label>
							<input type="text" name="jabatan" id="jabatan" class="form-control" value="<?php echo $erow['jabatan']; ?>" autocomplete="off" required>
						</div>
						<div class="row">
							<div class="col">
								<div class="mb-3">
									<label class="form-label">Tempat Lahir</label>
									<input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" value="<?php echo $erow['tempat_lahir']; ?>" autocomplete="off" required>
								</div>
							</div>
							<div class="col">
								<div class="mb-3">
									<label class="form-label">Tanggal Lahir</label>
									<input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="<?php echo $erow['tanggal_lahir']; ?>" autocomplete="off" required>
								</div>
							</div>
						</div>
						<div class="mb-3">
							<label class="form-label">Jenis Kelamin</label>
							<select class="form-select" name="jenis_kelamin" id="jenis_kelamin">
								<option>-Pilih-</option>
								<option value="Laki - Laki"<?php if ($erow['jenis_kelamin'] == 'Laki - Laki') { ?> selected='' <?php } ?>>Laki - Laki</option>
								<option value="Perempuan"<?php if ($erow['jenis_kelamin'] == 'Perempuan') { ?> selected='' <?php } ?>>Perempuan</option>                                        
							</select>
						</div>
						<div class="mb-3">
							<label for="gambar" class="form-label">Gambar <i>(Saat ini)</i></label> <br>
							<img src="../foto/<?= $erow['foto']; ?>" width="50%" style="margin-bottom: 10px;">
							<input class="form-control form-control-sm w-50" id="gambar" name="gambar" type="file">
						</div>
						<a href="profil.php?nama=<?= $row['nama']; ?>" class="btn btn-danger" style="width: 100px;">Kembali</a>
						<button type="reset" class="btn btn-secondary" style="width: 100px;">Batal</button>
						<button type="submit" class="btn btn-warning" style="width: 100px;" name="simpan">Ubah</button>
					</form>
				</div>
				<footer class="text-center"><p>Copyright&copy;2024 - All Rights Reserved</p></footer>
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