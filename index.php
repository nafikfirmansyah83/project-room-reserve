<?php 
  include('include/koneksi.php');
?>
<!DOCTYPE html>
<html lang="en">
  	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Uniwara Class - Landing Page</title>

		<link
		href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
		rel="stylesheet"
		integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
		crossorigin="anonymous"
		/>
		<link rel="preconnect" href="https://fonts.googleapis.com" />
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
		<link
		href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap"
		rel="stylesheet"
		/>
		<link rel="stylesheet" href="css/style-landing.css" />
  	</head>
  	<body>
    	<div class="head-section">
      		<nav class="navbar navbar-expand-lg py-4">
        		<div class="container">
          			<a class="navbar-brand fw-bold" href="https://uniwara.ac.id/">Universitas PGRI Wiranegara</a>
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            			<span class="navbar-toggler-icon"></span>
          			</button>
          			<div class="collapse navbar-collapse" id="navbarNav">
            			<ul class="navbar-nav ms-auto">
              				<li class="nav-item ms-0 ms-md-3">
                				<a class="px-4 py-2 btn btn-primary" href="login-admin.php">Login</a>
              				</li>
            			</ul>
          			</div>
        		</div>
      		</nav>
			<header class="hero-section">
        		<div class="container">
          			<div class="row align-items-center py-4 g-5">
            			<div class="col-12 col-md-6">
              				<div class="text-center text-md-start">
                				<h1 class="display-md-2 display-4 fw-bold text-dark pb-2">
                  					<span class="text-primary">Otomatiskan </span>Pemesanan & Penjadwalan Kelas!!
                				</h1>
                				<p class="lead">Aktifkan 24/7 pemesanan online dengan konfirmasi instan. Publikasikan jadwal kelas Anda secara langsung</p>
               					<a class="btn btn-primary px-5 py-3 mt-3 fs-5 fw-medium" href="login-user.php">Pesan</a>
              				</div>
            			</div>
            			<div class="col-12 col-md-6">
              				<img src="assets/hero.webp" class="img-fluid" alt="a man using vr gadget"/>
			            </div>
          			</div>
        		</div>
      		</header>
    	</div>
    	<div class="container">
      		<div class="row align-items-center gx-3 gy-5 py-5 mt-5">
        		<div class="col-12 col-md-12 col-lg-5">
          			<img src="assets/img-1.webp" class="img-fluid mx-auto d-block" alt="a man using vr gadget"/>
        		</div>
        		<div class="col-12 col-md-12 text-center text-lg-start col-lg-7">
          			<h2 class="fw-bold text-primary fs-1 pb-3">Tentang Uniwara Class</h2>
          			<p class="about-text">
						Ruang kuliah adalah tempat dimana kita akan menempuh pendidikan yang diberikan, 
						ruang kuliah biasanya sudah ditetapkan sebelum masa semester diumumkan agar pembagian tiap ruang 
						tiap kelas bisa terbagi rata sesuai jumlah ruang kelas yang dapat digunakan tanpa terkecuali, 
						oleh karena itu seharusnya semua kelas pastinya sudah tersusun rapi sesuai mata kuliah yang ditempuh.
					</p>
					<p class="about-text">
						Situs web ini memiliki fitur untuk mengetahui informasi seputar ruang kuliah. Juga sebagai sarana permintaan /
						permohonan penggunaan ruang kuliah yang efisien dan mudah digunakan 
						untuk setiap mahasiswa. Tentunya karena hal ini dapat diakses melalui perangkat pribadi dan mahasiswa 
						tidak perlu lagi repot-repot untuk pergi ke kantor BAAK hanya menanyakan perihal ruang kuliah.
					</p>
        		</div>
      		</div>
    	</div>
		<div class="container">
			<div class="row my-2">
				<div class="col-md">
					<h3 class="fw-bold text-primary fs-1 pb-3 text-center">Cek Mata Kuliah</h3>
					<div class="container mt-5">
					<form method="get" action="" class="mb-3">
						<div class="input-group">
							<input type="text" class="form-control" id="search" name="search" placeholder="Cari....." autocomplete="off">
							<button type="submit" class="btn btn-primary">Cari</button>
						</div>
					</form>
					<div class="card">
						<div class="card-body table-wrapper">
							<?php
								if (isset($_GET['search'])) {
									$search = mysqli_real_escape_string($koneksi, $_GET['search']);
									$query = "SELECT * FROM ruangan NATURAL JOIN prodi WHERE matkul LIKE '%$search%'";
									$result = mysqli_query($koneksi, $query);
									// Tampilkan hasil pencarian dalam bentuk tabel
									if (mysqli_num_rows($result) > 0) {
										echo '<table class="table table-striped text-center">';
										echo '<thead>';
										echo '<tr>';
										echo '<th>Hari</th>';
										echo '<th>Jam</th>';
										echo '<th>Ruangan</th>';
										echo '<th>Gedung</th>';
										echo '<th>Mata Kuliah</th>';
										echo '<th>Prodi</th>';
										echo '</tr>';
										echo '</thead>';
										echo '<tbody>';
										while ($row = mysqli_fetch_assoc($result)) {
											echo '<tr>';
											echo '<td>' . $row['hari'] . '</td>';
											echo '<td>' . $row['jam'] . '</td>';
											echo '<td>' . $row['ruangan'] . '</td>';
											echo '<td>' . $row['gedung'] . '</td>';
											echo '<td>' . $row['matkul'] . '</td>';
											echo '<td>' . $row['prodi'] . '</td>';
											echo '</tr>';
										}
										echo '</tbody>';
										echo '</table>';
									} else {
										echo 'Tidak ada hasil pencarian.';
									}
									// Bebaskan sumber daya hasil
									mysqli_free_result($result);
								}
								// Tutup koneksi
								mysqli_close($koneksi);
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
    	<div class="features-section py-5">
      		<div class="container">
        		<h2 class="fs-1 fw-bold text-center pt-5 pb-5 text-primary">Fitur Utama</h2>
        		<div class="row g-5 pb-5">
         			<div class="col-md-6 col-lg-4">
            			<div class="card px-3 py-4 shadow-sm">
              				<ion-icon class="ionicons" name="bulb-outline"></ion-icon>
              				<h3 class="f5">Teknologi Inovatif</h3>
              				<p class="card-text lead">
							  	Periksa jadwal Anda, Pemesanan Online, Jadwalkan ulang dengan mudah. 
              				</p>
            			</div>
          			</div>
          			<div class="col-md-6 col-lg-4">
            			<div class="card px-3 py-4 shadow-sm blue-bg">
              				<ion-icon class="ionicons" name="shield-checkmark-outline"></ion-icon>
              				<h3 class="f5">Kualitas Keamanan</h3>
              				<p class="card-text lead">
							  Pemesanan kelas percobaan, Izinkan layanan mandiri, Komentar ruang kelas dengan bebas.
              				</p>
            			</div>
          			</div>
          			<div class="col-md-6 col-lg-4 offset-md-3 offset-0 offset-lg-0">
            			<div class="card px-3 py-4 shadow-sm">
              				<ion-icon class="ionicons" name="hourglass-outline"></ion-icon>
              				<h3 class="f5">Tepat Waktu</h3>
              				<p class="card-text lead">
							  	Lihat pemesanan secara realtime, Lacak ruang kelas, Pesan dari mana saja.
              				</p>
            			</div>
          			</div>
        		</div>
      		</div>
    	</div>
		<div class="container py-5 mb-5">
      		<div class="row">
        		<div class="col-12">
          			<h2 class="fw-bold text-primary fs-1 pb-3 text-center">Bagaimana itu bekerja</h2>
          			<div class="accordion" id="accordionExample">
            			<div class="accordion-item">
              				<h2 class="accordion-header">
                				<button class="accordion-button fs-3 text-dark fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
									Bagaimana cara menelusuri dan menjelajahi tentang ruang kuliah di UNIWARA?
                				</button>
              				</h2>
              				<div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                				<div class="accordion-body">
								<p class="lead">
									Melihat detail ruangan sesuai mata kuliah Anda dari situs web ini sangatlah mudah. Setelah Anda 
									memasukkan mata kuliah yang sesuai, cukup tekan tombol cari yang sudah tersedia di tampilan Anda dan 
									disitu tertera mata kuliah yang Anda cari lengkap beserta Ruangan, Gedung, Fakultas, Prodi, dan lain 
									sebagainya. Setelah menemukan mata kuliah, Anda bisa menemukan di ruang mana Anda berkuliah.  
								</p>
							</div>
						</div>
					</div>
            		<div class="accordion-item">
              			<h2 class="accordion-header">
							<button class="accordion-button collapsed fs-3 text-dark fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
								Seperti apa proses pemesanannya?
							</button>
              			</h2>
              			<div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                			<div class="accordion-body">
                  				<p class="lead">
								 	Memesan penjadwalan ulang ruang kuliah Anda inginkan melalui situs web ini sangatlah mudah. Setelah 
									Anda menemukan ruang kuliah yang sesuai, cukup tekan tombol pesan yang sudah tersedia di tampilan Anda 
									dan lanjutkan ke pengisian data dari mata kuliah Anda, pastikan data Anda sudah benar agar dapat 
									diproses. Proses penerimaan ruang kuliah yang anda pilih sangat efisien memungkinkan Anda meninjau 
									pesanan Anda, memasukkan sebuah kata yang detail jika ruangan yang dipilih memiliki kekurangan. 
									Yakinlah, semua kritik dan saran Anda terlindungi, dan pesanan Anda akan diproses dengan cepat
									sesuai jam operasional.
                 				</p>
                			</div>
              			</div>
            		</div>
            		<div class="accordion-item">
              			<h2 class="accordion-header">
                			<button class="accordion-button collapsed fs-3 text-dark fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
								Bagaimana Situs ini memastikan kepuasan pelanggan?
							</button>
						</h2>
              			<div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                			<div class="accordion-body">
                  				<p class="lead">
								  	Kepuasan pelanggan adalah prioritas utama kami. Kami berkomitmen untuk memberikan ruangan yang 
									berkualitas tinggi dan layanan yang luar biasa. Tim kami dengan cermat memeriksa dan mengemas setiap 
									pesanan, memastikan ruangan dalam kondisi sempurna. Selain itu, dukungan responsif kami siap membantu 
									menjawab pertanyaan atau permasalahan apa pun yang Anda miliki. Bergabunglah dengan komunitas pelanggan 
									kami yang puas yang mempercayai UNIWARA untuk pengalaman berkuliah yang lancar dan menyenangkan.
                  				</p>
                			</div>
              			</div>
            		</div>
          		</div>
        	</div>
      	</div>
    </div>
    <footer class="text-center"><p>Copyright&copy;2024 - All Rights Reserved</p></footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  	</body>
</html>