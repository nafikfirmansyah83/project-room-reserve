<?php 
    include('include/koneksi.php');
    include("include/akses admin.php"); 
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style-login.css">
        <title>Uniwara Class - Login Admin</title>
    </head>
    <body>
        <div class="container d-flex justify-content-center align-items-center min-vh-100">
            <div class="row border rounded-5 p-3 bg-white shadow box-area">
                <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background: #0e2238">
                    <div class="featured-image mb-3">
                        <img src="https://student.wiraakademik.uniwara.ac.id:8083/images/logo.png" class="img-fluid" style="width: 250px;">
                    </div>
                    <p class="text-white fs-2" style="font-family: 'Courier New', Courier, monospace; font-weight: 600;">Uniwara Class</p>
                    <small class="text-white text-wrap text-center" style="width: 17rem;font-family: 'Courier New', Courier, monospace;">Come on, book your class now, meet the schedule changes from the lecturer.</small>
                </div>
                <div class="col-md-6 right-box">
                    <div class="row align-items-center">
                        <div class="header-text mb-4">
                            <h2>Hello, Sobat Patriot</h2>
                            <p>We are happy to have you back.</p>
                        </div>
                        <form method="post" action="">
                            <div class="input-group mb-3">
                                <input type="email" name="email" class="form-control form-control-lg bg-light fs-6" placeholder="Email address">
                            </div>
                            <div class="input-group mb-1">
                                <input type="password" name="password" class="form-control form-control-lg bg-light fs-6" placeholder="Password">
                            </div>
                            <?php
								if(isset($_POST['login'])){
									$email = mysqli_real_escape_string($koneksi, htmlentities($_POST['email']));
									$pass  = mysqli_real_escape_string($koneksi, htmlentities(md5($_POST['password'])));

									$sql = mysqli_query($koneksi, "select*from user where email='$email' and password='$pass' and status='aktif'") or die(mysqli_error($koneksi));
									if(mysqli_num_rows($sql) == 0){
										echo '<div class="alert alert-danger" role="alert">
                                        Login Gagal! Email atau Password Salah!
                                      </div>';
									}else{
										$row = mysqli_fetch_assoc($sql);
											if($row){
												$_SESSION['email']=$email;
												echo '<script language="javascript">document.location="admin/index.php";</script>';
											}else{
												echo '<div class="alert alert-primary d-flex align-items-center" role="alert">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                                  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg>
                                                <div>
                                                Upss...!!! Login gagal!.
                                                </div>
                                              </div>';
											}
									}
								}
							?>
                            <div class="input-group mb-5 d-flex justify-content-between">
                                <div class="forgot position-absolute top-0 end-0">
                                    <small><a href="forgot-pass-admin.php">Forgot Password?</a></small>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <button class="btn btn-lg w-100 fs-6 text-white" type="submit" name="login" style="background: #0e2238">Login</button>
                            </div>
                            <div class="row">
                                <small>Don't have account? <a href="register-admin.php">Sign Up</a></small>
                            </div>
                        </form>
                    </div>
                </div> 
            </div>
        </div>
        <footer class="text-center"><p>Copyright&copy;2024 - All Rights Reserved</p></footer>
    </body>
</html>