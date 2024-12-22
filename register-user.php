<?php 
    include('include/koneksi.php');
?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Uniwara Class - Daftar Koordinator</title>
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
		<!------------------------Proses Tambah Koordinator-------------------->
		<?php
            if(isset($_POST['tambah'])){ 
                $email            = $_POST['email'];
                $nim              = $_POST['nim'];
                $nama             = $_POST['nama'];
                $jenis_kelamin    = $_POST['jenis_kelamin'];
                $tempat_lahir     = $_POST['tempat_lahir'];
                $tanggal_lahir    = $_POST['tanggal_lahir'];
                $angkatan 		  = $_POST['angkatan'];
                $id_fakultas      = $_POST['id_fakultas'];
                $id_prodi		  = $_POST['id_prodi'];
                $pass1            = $_POST['password1'];
                $pass2            = $_POST['password2'];
                $gambar 		  = upload();
        

                if (!$gambar) {
                    return false;
                }
                $cek = $koneksi->query("SELECT * FROM koordinator WHERE nim='$nim' OR email='$email'");
                if($cek->num_rows == 0){
                    if($pass1 == $pass2){ 
                        $pass = md5($pass1); 
                        $insert = $koneksi->query("INSERT INTO koordinator(
                                                email,
                                                password,
                                                nim,
                                                nama,
                                                tempat_lahir,
                                                tanggal_lahir,
                                                jenis_kelamin,
                                                angkatan,
                                                id_fakultas,
                                                id_prodi,
                                                foto,
                                                status)
                                            VALUES(
                                                '$email',
                                                '$pass',
                                                '$nim',
                                                '$nama',
                                                '$tempat_lahir',
                                                '$tanggal_lahir',
                                                '$jenis_kelamin',
                                                '$angkatan',
                                                '$id_fakultas',
                                                '$id_prodi',
                                                '$gambar',
                                                'non aktif')") or die(mysqli_error());
                        if($insert){ 
                            echo '<script language="javascript">alert("Selamat, Data Anda berhasil dibuat, Tunggu Maksimal 1x24 untuk dikonfirmasi!"); document.location="login-admin.php";</script>';
                        }else{ 
                            echo '<script language="javascript">alert("Upss, Data Anda gagal dibuat, Coba ulangi!!");</script>';
                        }
                    } else{ 
                        echo '<script language="javascript">alert("Password Tidak Sesuai!");</script>';
                    }
                }else{ 
                    echo '<script language="javascript">alert("Email Sudah Digunakan!");</script>';
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
                            <form action="register-user.php" method="post" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="text" name="email" id="email" class="form-control" placeholder="ex : example@gmail.com" required>
                                </div>
                                <div class="row">
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
                                </div>
                                <br>
                                <h4 class="fw-bold text-uppercase text-center" >Biodata</h4>
                                <hr>
                                <div class="mb-3">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input type="text" name="nama" id="nama" class="form-control" placeholder="ex : Larry the Bird" autocomplete="off" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Nomor Induk Mahasiswa</label>
                                    <input type="text" name="nim" id="nim" class="form-control" placeholder="ex : 2010704030" autocomplete="off" required>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label">Tempat Lahir</label>
                                            <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" placeholder="ex : Mandalika" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label">Tanggal Lahir</label>
                                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" autocomplete="off" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Fakultas</label>
                                    <select class="form-select" name="id_fakultas" style="width: 100%;" id="fakultas" required>
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
                                    <select class="form-select" name="id_prodi" id="prodi" style="width: 100%;" required>
                                        <option>-Pilih-</option>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label">Angkatan</label>
                                            <input type="text" name="angkatan" id="angkatan" class="form-control" placeholder="ex : 2040" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label">Jenis Kelamin</label>
                                            <select class="form-select" name="jenis_kelamin" id="jenis_kelamin" style="width: 100%;" required>
                                                <option>-Pilih-</option>
                                                <option value="Laki-Laki">Laki-Laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            </select>
                                        </div>	
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="gambar" class="form-label">Upload Foto</label>
                                    <input class="form-control form-control-sm w-50" id="gambar" name="gambar" type="file">
                                </div>
                                <a href="login-user.php" class="btn btn-danger" style="width: 100px;">Kembali</a>
                                <button type="reset" class="btn btn-secondary" style="width: 100px;">Batal</button>
                                <button type="submit" class="btn btn-warning" style="width: 100px;" name="tambah">Tambah</button>
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