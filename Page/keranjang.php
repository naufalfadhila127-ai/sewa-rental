<?php
if(isset($_SESSION['id_pelanggan'])){
	?>
	<div class="col-md-12 ftco-animate">
		<div class="cart-list">
			<table class="table">
				<thead class="thead-primary">
					<tr class="text-center">
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>Nama Produk</th>
						<th>Harga</th>
						<th>Quantity</th>
						<th>Total</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$id_pelanggan = $_SESSION['id_pelanggan'];
					$data = mysqli_query($koneksi,"select * from keranjang a left join barang b on a.kd_barang = b.kd_barang where a.id_pelanggan='$id_pelanggan'");
					$no=1;
					$total_pemesanan =0;
					if($data){
						while($result=mysqli_fetch_object($data)){  
							$total_pemesanan += $result->qty * $result->harga;
							?>
							<tr class="text-center">
								<td class="product-remove"><a href="index.php?page=cart&aksi=clear&kd_barang=<?php echo $result->kd_barang ?>"><span class="ion-ios-close"></span></a></td>
								
								<td class="image-prod"><div class="img" style="background-image:url(<?php echo "images/$result->gambar" ?>);"></div></td>
								
								<td class="product-name">
									<h3><?php echo $result->nama_barang ?></h3>
								</td>
								<td class="price">Rp <?php echo number_format($result->harga) ?></td>
								
								<td class="product-name">
									<p><a href="index.php?page=cart&aksi=min&kd_barang=<?php echo $result->kd_barang ?>" class="btn btn-sm btn-primary">-</a>
										<?php echo $result->qty ?>
										<a href="index.php?page=cart&aksi=add&kd_barang=<?php echo $result->kd_barang ?>" class="btn btn-sm btn-primary">+</a>
									</p>
								</td>
								<td class="total">Rp <?php echo number_format($result->qty * $result->harga) ?></td>
							</tr><!-- END TR-->
							<?php 
						}
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="row justify-content-end">
	<div class="col-lg-4 mt-5 cart-wrap ftco-animate">
		
	</div>
	<div class="col-lg-4 mt-5 cart-wrap ftco-animate">
		
	</div>
	<div class="col-lg-4 mt-5 cart-wrap ftco-animate">
		<div class="cart-total mb-3">
			<h3>Cart Totals</h3>
			<hr>
			<p class="d-flex total-price">
				<span>Total</span>
				<span>Rp <?php echo number_format($total_pemesanan) ?></span>
			</p>
		</div>
		<p><a href="index.php?page=cart&aksi=checkout" class="btn btn-primary py-3 px-4">Checkout</a></p> </div>
		<?php
	}else{
		echo "<meta http-equiv='refresh' content='0 url=index.php?page=login'>";
	}
	?>