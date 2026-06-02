<div class="col-md-12 heading-section text-center ftco-animate">
          	<span class="subheading">Car Greenrent</span>
            <h2 class="mb-4">Semua Unit Kendaraan Kami</h2>
            <p>Unit kendaraan yang berkualitas dan kesehatan setiap kendaraan selalu terjaga</p>
          </div>
        </div>   		
    	</div>
    	<div class="container">
    		<div class="row">
                <?php
                $data = mysqli_query($koneksi,"select * from barang");
                $no=1;
                if($data){
                    while($result=mysqli_fetch_object($data)){
                ?>
    			<div class="col-md-6 col-lg-3 ftco-animate">
    				<div class="product">
    					<a href=<?php echo "index.php?page=detail_produk&id=$result->kd_barang" ?> class="img-prod"><img class="img-fluid" src=<?php echo "images/$result->gambar" ?> alt="Colorlib Template">
    						<div class="overlay"></div>
    					</a>
    					<div class="text py-3 pb-4 px-3 text-center">
    						<h3><a href="#"><?php echo $result->nama_barang  ?></a></h3>
    						<div class="d-flex">
    							<div class="pricing">
		    					Rp	<?php echo number_format($result->harga)  ?>
		    					</div>
	    					</div>
	    					<div class="bottom-area d-flex px-3">
	    						<div class="m-auto d-flex">
	    							<a href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">
	    								<span><i class="ion-ios-menu"></i></span>
	    							</a>
	    							<a href="#" class="buy-now d-flex justify-content-center align-items-center mx-1">
	    								<span><i class="ion-ios-cart"></i></span>
	    							</a>
	    							<a href="#" class="heart d-flex justify-content-center align-items-center ">
	    								<span><i class="ion-ios-heart"></i></span>
	    							</a>
    							</div>
    						</div>
    					</div>
    				</div>
    			</div>
    			<?php
                $no++;
            }
        }
        ?>