<?php
    session_start();
    unset($_SESSION['id_pelanggan']);
    unset($_SESSION['nama_pelanggan']);
    unset($_SESSION['telp_pelanggan']);
    echo "<meta http-equiv='refresh' content='0 url=index.php?page=login'>";
?>