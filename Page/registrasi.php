<?php
    if(isset($_POST['submit'])){
        $id_pelanggan       = $_POST['id_pelanggan'];  
        $password           = $_POST['password']; 
        $nama_pelanggan     = $_POST['nama_pelanggan'];  
        $alamat_pelanggan   = $_POST['alamat_pelanggan'];  
        $telp_pelanggan     = $_POST['telp_pelanggan']; 
        $email_pelanggan    = $_POST['email_pelanggan'];

        if(empty($id_pelanggan) || empty($password) || empty($nama_pelanggan) || empty($alamat_pelanggan)) {
            echo "<meta http-equiv='refresh' content='0 url=index.php?page=registrasi'>";
        }else{  
         $insert = mysqli_query($koneksi, "INSERT INTO pelanggan(id_pelanggan, password, nama_pelanggan, alamat_pelanggan, telp_pelanggan, email_pelanggan) 
             VALUES('$id_pelanggan','$password','$nama_pelanggan','$alamat_pelanggan','$telp_pelanggan','$email_pelanggan')");  
            if($insert){
                echo "<meta http-equiv='refresh' content='0 url=index.php?page=login'>";
            }
        }
    }
?>
<div class="card" style="width: 60%">
    <h1 class="h3 mb-0 text-gray-800">Registrasi Pelanggan</h1>
    <div class= card-body>
        <form method="POST" action="">
            <div class="form-group">
                <label>ID Pelanggan</label>
                <input type="text" name="id_pelanggan" class="form-control">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama_pelanggan" class="form-control">
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <input type="text" name="alamat_pelanggan" class="form-control">
            </div>
            <div class="form-group">
                <label>No.Hp</label>
                <input type="text" name="telp_pelanggan"  class="form-control">
            </div>
            <div class="form-group">
                <label>email_pelanggan</label>
                <input type="text" name="email_pelanggan"  class="form-control">
            </div>
            <button type="submit" name="submit" class="btn btn-success mt-3 ">Simpan</button>
        </form>
    </div>
</div>