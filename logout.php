<?php
    session_start();
    unset($_SESSION['email']);
    session_destroy();
    
    echo '<script language="javascript">alert("Anda berhasil Logout!"); document.location="index.php";</script>'; // memunculkan peringatan kemudian me-redirect ke halaman depan
?>