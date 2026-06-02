<?php
session_start();
require_once("config/koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title> Sewa Rental Mobil </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">

    
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body class="goto-here">
		<div class="py-1 bg-primary">
    	<div class="container">
    		<div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
	    		<div class="col-lg-12 d-block">
		    		<div class="row d-flex">
		    			<div class="col-md pr-4 d-flex topper align-items-center">
					    	<div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
						    <span class="text">+62 813 6860 7715</span>
					    </div>
					    <div class="col-md pr-4 d-flex topper align-items-center">
					    	<div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
						    <span class="text">naufal.fadhila127@gmail.com</span>
					    </div>
					    <div class="col-md-5 pr-4 d-flex topper align-items-center text-lg-right">
						    <span class="text">layanan antar jemput unit kapan saja &amp; dimana saja </span>
					    </div>
				    </div>
			    </div>
		    </div>
		  </div>
    </div>
    
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="index.html">Car Greenrent</a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item active"><a href="index.php" class="nav-link">Home</a></li>
	          <li class="nav-item dropdown">
              
              <div class="dropdown-menu" aria-labelledby="dropdown04">
              	<a class="dropdown-item" href="index.php?page=sayur">Sayur</a>
              	<a class="dropdown-item" href="index.php?page=buah">Buah</a>
                
              </div>
            </li>
	          <li class="nav-item"><a href="index.php?page=riwayat" class="nav-link">Riwayat Pesanan</a></li>
	          <li class="nav-item"><a href="index.php?page=pembayaran" class="nav-link">Pembayaran</a></li>
	          <li class="nav-item"><a href="index.php?page=pengiriman" class="nav-link">Pengiriman</a></li>
	          <li class="nav-item cta cta-colored"><a href="index.php?page=keranjang" class="nav-link"><span class="icon-shopping_cart"></span>Keranjang</a></li>
            <?php
	          	if(isset($_SESSION['id_pelanggan'])) {
	          		?><li class="nav-item"><a href="index.php?page=logout" class="nav-link">logout, <?php echo $_SESSION['nama_pelanggan'] ?>
	          	</a></li>
	          		<?php
	          }else{
	          		?><li class="nav-item"><a href="index.php?page=login" class="nav-link">Login</a></li>
	          		<?php
	          }
	          ?>
	        </ul>
	      </div>
	    </div>
	  </nav>
    <!-- END nav -->

    <section id="home-section" class="hero">
		  <div class="home-slider owl-carousel">
	      <div class="slider-item" style="background-image: url(images/gambar-home1-.png);">
	      	<div class="overlay"></div>
	        <div class="container">
	          <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

	            <div class="col-md-12 ftco-animate text-center">
	              <h1 class="mb-2">Kami Menyediakan Hampir Segala Jenis Unit</h1>
	              <h2 class="subheading mb-4">Baik LCGC, MVP, SUV, Pickup, dll</h2>
	            </div>

	          </div>
	        </div>
	      </div>

	      <div class="slider-item" style="background-image: url(images/gambar-home3-.png);">
	      	<div class="overlay"></div>
	        <div class="container">
	          <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

	            <div class="col-sm-12 ftco-animate text-center">
	              <h1 class="mb-2">Siap Melayani Konsumen dengan Nyaman</h1>
	              <h2 class="subheading mb-4">Siap antar jemput unit kendaraan</h2>
	            </div>

	          </div>
	        </div>
	      </div>
	    </div>
    </section>

    <section class="ftco-section">
			<div class="container">
				<div class="row no-gutters ftco-services">
          <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services mb-md-0 mb-4">
              <div class="icon bg-color-1 active d-flex justify-content-center align-items-center mb-2">
            		  <img src="images/gambar-rental-mobil.png" alt="Logo" width="60">
              </div>
              <div class="media-body">
                <h3 class="heading">Layanan Antar Jemput</h3>
                <span>Baik antar jemput ke bandara maupun pelabuhan</span>
              </div>
            </div>      
          </div>
          <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services mb-md-0 mb-4">
              <div class="icon bg-color-2 d-flex justify-content-center align-items-center mb-2">
            		 <img src="images/kunci-mobil.png" alt="Logo" width="60">
              </div>
              <div class="media-body">
                <h3 class="heading">Bisa Lepas Kunci</h3>
                <span>Bisa request tanpa supir maupun ada supir</span>
              </div>
            </div>    
          </div>
          <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services mb-md-0 mb-4">
              <div class="icon bg-color-3 d-flex justify-content-center align-items-center mb-2">
            		<img src="images/gambar-mobil-mobil.png" alt="Logo" width="90">
              </div>
              <div class="media-body">
                <h3 class="heading">Beragam Jenis Mobil</h3>
                <span>Mulai dari LCGC hingga SUV</span>
              </div>
            </div>      
          </div>
          <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services mb-md-0 mb-4">
              <div class="icon bg-color-4 d-flex justify-content-center align-items-center mb-2">
            		<img src="images/gambar-uang.png" alt="Logo" width="60">
              </div>
              <div class="media-body">
                <h3 class="heading">Bayar Belakangan</h3>
                <span>Bisa bayar cash ataupun cicilan</span>
              </div>
            </div>      
          </div>
        </div>
			</div>
		</section>

		<section class="ftco-section ftco-category ftco-no-pt">
			<div class="container">
				<div class="row"> 
					<?php
					if(isset($_GET['page'])){
					$halaman = $_GET["page"];	
				}else{	
					$halaman = "";
				}
				if($halaman == ""){
					include "page/home.php"; 
				}else if(!file_exists("page/$halaman.php")){
					echo "halaman yang dicari tidak ditemukan";
				}else{
					include "page/$halaman.php";
        }
        ?>
       </div>
      </div>
    </section>
    <footer class="ftco-footer ftco-section">
      <div class="container">
      	<div class="row">
      		<div class="mouse">
						<a href="#" class="mouse-icon">
							<div class="mouse-wheel"><span class="ion-ios-arrow-up"></span></div>
						</a>
					</div>
      	</div>
        <div class="row mb-5">
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2"style="color: green;" >CAR GREENRENT</h2>
              <p>Dijamin amanah, lengkap, terjangkau, aman, dan nyaman. Harga sewa yang tertera di menu adalah harga sewa per 24 jam (menambah pesanan lebih dari 1= menambah unit/jumlah kendaraan yang disewa).</p>
              <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4 ml-md-3">
              </ul>
            </div>
          </div>
          <div class="col-md-4">
             <div class="ftco-footer-widget mb-4" style="margin-left:-70px;">
              <h2 class="ftco-heading-2"style="color: black; font-weight: bold;" >Anggota Kelompok</h2>
              <div class="d-flex">
	              <ul class="list-unstyled mr-l-5 pr-l-3 mr-4">
	                <li><a href="#" class="py-2 d-block">Muhammad Naufal Fadhila (3042411016)</a></li>
	                <li><a href="#" class="py-2 d-block">Steki Arjuna (3042411076)</a></li>
	                <li><a href="#" class="py-2 d-block">Muhammad Irfan Mumtaz (3042411101)</a></li>
	              </ul>
	              <ul class="list-unstyled">
	              </ul>
	            </div>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
            	<h2 class="ftco-heading-2">Alamat Email Kami</h2>
            	<div class="block-23 mb-3">
	              <ul>
	              <li><a href="mailto:naufal.fadhila127@gmail.com"><span class="icon icon-envelope"></span><span class="text">naufal.fadhila127@gmail.com</span></a></li>
	              <li><a href="mailto:stekiarjuna@gmail.com"><span class="icon icon-envelope"></span><span class="text">stekiarjuna@gmail.com</span></a></li>
	              <li><a href="mailto:mirfanmumtaz670@gmail.com"><span class="icon icon-envelope"></span><span class="text">mirfanmumtaz670@gmail.com</span></a></li>
	            </ul>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-center">

            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						</p>
          </div>
        </div>
      </div>
    </footer>
    
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>
    
  </body>
</html>