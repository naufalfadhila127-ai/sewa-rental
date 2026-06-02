<?php
if (isset($_POST['submit'])) {
	$id_pelanggan	= $_POST['id_pelanggan'];
	$password 		= $_POST['password'];
	if (empty($id_pelanggan) || empty($password)){
		echo '<div class="warning"> Data Tidak Boleh Kosong</div>';
	}else{
	    //cek data pelanggan di database
	    $query = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE 
	    	id_pelanggan='$id_pelanggan' AND password='$password'");
	    if(mysqli_num_rows($query) === 0) { 
	    	//gagal
	        echo "<meta http-equiv='refresh' content='0 url=index.php?page=login'>";
	    }else{
	    	//berhasil login
	        $row = mysqli_fetch_assoc($query);
	        session_start();
	        $_SESSION['id_pelanggan'] = $row['id_pelanggan'];
	        $_SESSION['nama_pelanggan'] = $row['nama_pelanggan'];
	        $_SESSION['telp_pelanggan'] = $row['telp_pelanggan'];
	        echo "<meta http-equiv='refresh' content='0 url=index.php'>";
	    }
	}
}
?>
<form method="post" action=""><br><br>
	<h2 style="text-align: center">Login</h2>
	<input type="text" name="id_pelanggan" placeholder="ID Pelanggan" class="form-control"><br>
	<input type="password" id="pass" name="password" placeholder="Password" class="form-control"><br>
	<input type="submit" name="submit" value="Login" class="btn btn-lg btn-success">
	<a href="index.php?page=registrasi" class="btn btn-lg btn-warning">Register</a>
</form>