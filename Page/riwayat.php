<?php
if(isset($_SESSION['id_pelanggan'])){
?>
<section class="ftco-section ftco-cart">
    <div class="container">
        <div class="row">
            <div class="col-md-12 ftco-animate">
                <div class="cart-list">
                    <table class="table">
                        <thead class="thead-primary">
                            <tr class="text-center">
                                <th>No.</th>
                                <th>No Pemesanan</th>
                                <th>&nbsp;</th>
                                <th>Tanggal Pemesanan</th>
                                <th>Status Pesanan</th>
                                <th>Total Pemesanan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $id_pelanggan = $_SESSION['id_pelanggan'];
                            $data = mysqli_query($koneksi,"select * from pemesanan where id_pelanggan='$id_pelanggan'");
                            $no=1;
                            if($data)
                                {while($result=mysqli_fetch_object($data)){
                                    ?>
                                    <tr class="text-center">
                                        <td class="product-name"><?php echo $no ?></td>
                                        <td class="product-name">
                                            <h3><?php echo $result->no_pemesanan ?></h3>
                                        </td>
                                        <td class="product-name"></td>
                                        <td class="product-name">
                                            <h3><?php echo $result->tanggal_pemesanan ?></h3>
                                        </td>
                                        <td class="product-name">
                                            <h3><?php echo $result->status_pemesanan ?></h3>
                                        </td>
                                        <td class="product-name">
                                            <h3>Rp <?php echo number_format($result->total_pemesanan) ?></h3>
                                        </td>
                                    </tr><!-- END TR-->

                                    <?php
                                    $detail = mysqli_query($koneksi,"select a.*,b.nama_barang,b.gambar from pemesanan_detail a
                                        left join barang b on a.kd_barang = b.kd_barang
                                        where a.no_pemesanan='$result->no_pemesanan'");

                                    $sub_total = 0;

                                    if($detail){
                                        while($result_detail=mysqli_fetch_object($detail)){ ?>
                                            <tr class="product-name" style="height: 30px">
                                                <td></td>

                                                <td class="image-prod" style="height: 30px">
                                                    <div class="img" style="background-image:url(
                                                        <?php echo "images/$result_detail->gambar" ?>
                                                    );"></div>
                                                </td>

                                                <td class="product-name" style="height: 30px">
                                                    <h3><?php echo $result_detail->nama_barang ?></h3>
                                                </td>
                                                <td>Rp <?php echo number_format($result_detail->harga) ?></td>

                                                <td class="product-name" style="height: 30px">
                                                    <div>
                                                        <?php echo $result_detail->qty ?>
                                                    </div>
                                                </td>

                                                <td class="product-name" style="height: 30px">
                                                    Rp <?php echo number_format($result_detail->harga * $result_detail->qty) ?>
                                                </td>
                                            </tr><!-- END TR-->

                                            <?php
                                         }
                                      }
                                $no++;
                                }
                            } ?>
                            
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</section>

<?php
}else{
    echo "<meta http-equiv='refresh' content='0 url=index.php?page=login'>";
}
?>