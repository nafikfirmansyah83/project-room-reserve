<?php 
	include('../include/koneksi.php');
	include("include/akses admin.php");
?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Uniwara Class - Tambah Ruangan</title>
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

			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				$hari = $_POST['hari'];
				$jam = $_POST['jam'];
				$ruangan = $_POST['ruangan'];
				$matkul = $_POST['matkul'];
				$id_fakultas = $_POST['id_fakultas'];
				$id_prodi = $_POST['id_prodi'];
				$kondisi = $_POST['kondisi'];
				$catatan = $_POST['catatan'];
			
				// Escape special characters in a string for use in an SQL statement
				$hari = $koneksi->real_escape_string($hari);
				$jam = $koneksi->real_escape_string($jam);
				$ruangan = $koneksi->real_escape_string($ruangan);
				$matkul = $koneksi->real_escape_string($matkul);
				$id_fakultas = $koneksi->real_escape_string($id_fakultas);
				$id_prodi = $koneksi->real_escape_string($id_prodi);
				$kondisi = $koneksi->real_escape_string($kondisi);
				$catatan = $koneksi->real_escape_string($catatan);
				$email = $koneksi->real_escape_string($email);
			
				// Query untuk menambah data ke database
				$sql = "INSERT INTO ruangan (hari, jam, ruangan, matkul, id_fakultas, id_prodi, kondisi, catatan) 
						VALUES ('$hari', '$jam', '$ruangan', '$matkul', '$id_fakultas', '$id_prodi', '$kondisi', '$catatan')";
			
				if ($koneksi->query($sql) === TRUE) {
					echo '<script language="javascript">alert("Berhasil menambah Ruangan!"); document.location="ruangan data.php";</script>';
				} else {
					echo '<script language="javascript">alert("Gagal menambah Ruangan!");</script>';
				}
			
				$koneksi->close();
			}
		?>
		<div class="container">
			<div class="row my-2">
				<div class="col-md">
					<h3 class="fw-bold text-uppercase">Tambah Data Ruangan</h3>
				</div>
				<hr>
			</div>
			<div class="row my-2">
				<div class="col-md">
					<form action="ruangan tambah.php" method="post" enctype="multipart/form-data">
					<div class="row">
						<div class="col">
							<div class="mb-3">
								<label class="form-label">Hari</label>
								<select class="form-select" name="hari" id="hari">
									<option>-Pilih-</option>
									<option value="Senin">Senin</option>
									<option value="Selasa">Selasa</option>
									<option value="Rabu">Rabu</option>
									<option value="Kamis">Kamis</option>
									<option value="Jumat">Jum'at</option>
									<option value="Sabtu">Sabtu</option>                                        
								</select>
							</div>
						</div>
						<div class="col">
							<div class="mb-3">
								<label class="form-label">Jam</label>
								<select class="form-select" name="jam" id="jam">
									<option>-Pilih-</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="9">9</option>                                        
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<div class="mb-3">
								<label class="form-label">Ruangan</label>
								<input type="text" name="ruangan" id="ruangan" class="form-control" placeholder="ex : Ruang 101" autocomplete="off" required>
							</div>
						</div>
						<div class="col">
							<div class="mb-3">
							<label class="form-label" required>Kondisi</label>
							<select class="form-select" name="kondisi" id="kondisi">
								<option>-Pilih-</option>
								<option value="KOSONG">KOSONG</option>
								<option value="MENUNGGU">MENUNGGU</option>
								<option value="TERISI">TERISI</option>                                        
							</select>
							</div>
						</div>
					</div>
					<div class="mb-3">
						<label class="form-label">Mata Kuliah</label>
						<input type="text" name="matkul" id="matkul" class="form-control" placeholder="ex : Akuntansi" autocomplete="off">
					</div>
					<div class="mb-3">
						<label class="form-label">Fakultas</label>
						<select class="form-select" name="id_fakultas" style="width: 100%;" id="fakultas">
							<option>-Pilih-</option>
            					<?php 
						   			$result = $koneksi->query("SELECT * FROM fakultas");        
									while ($erow2 = mysqli_fetch_array($result))
									{    
										echo '<option value="'.$erow2['id_fakultas'].'">'.$erow2['fakultas'].'</option>';   
								 	}      
								?>
            			</select>
					</div>
					<div class="mb-3">
						<label class="form-label">Program Studi</label>
						<select class="form-select" name="id_prodi" id="prodi" style="width: 100%;">
							<option>-Pilih-</option>
            			</select>
					</div>
					<div class="mb-3">
						<label class="form-label">Catatan</label>
						<input type="text" name="catatan" id="catatan" class="form-control" autocomplete="off">
					</div>
					<a href="ruangan data.php" class="btn btn-danger" style="width: 100px;">Kembali</a>
					<button type="reset" class="btn btn-secondary" style="width: 100px;">Batal</button>
					<button type="submit" class="btn btn-warning" style="width: 100px;" name="tambah">Tambah</button>
					</form>
				</div>
			</div>
			<footer class="text-center"><p>Copyright&copy;2024 - All Rights Reserved</p></footer>
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
		<!-- Pilih Prodi -->
		<script>
		    $("#fakultas").change(function(){
        		// variabel dari nilai combo box Fakultas
       			var id_fakultas = $("#fakultas").val();
        		// mengirim dan mengambil data
        		$.ajax({
            		type: "POST",
            		dataType: "html",
            		url: "include/prodi.php",
            		data: "fakultas="+id_fakultas,
            		success: function(msg){
                		// jika tidak ada data
                		if(msg == ''){
                		    alert('Tidak ada data Jurusan');
                		}
                		// jika dapat mengambil data,, tampilkan di combo box jurusan
                		else{
                    		$("#prodi").html(msg);
                		}
            		}
        		});
    		});
		</script>
	</body>
</html>