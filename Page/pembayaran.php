<?php
if(isset($_SESSION['id_pelanggan'])){
    $id_pelanggan = $_SESSION['id_pelanggan'];
    
    // 1. MENGAMBIL DATA PEMESANAN TERBARU YANG BARU CHECKOUT
    $query_pesanan = mysqli_query($koneksi, "SELECT * FROM pemesanan WHERE id_pelanggan='$id_pelanggan' ORDER BY tanggal_pemesanan DESC, no_pemesanan DESC LIMIT 1");
    
    if(mysqli_num_rows($query_pesanan) > 0) {
        $result = mysqli_fetch_object($query_pesanan);
        $no_pemesanan = $result->no_pemesanan;

        // 2. LOGIKA KETIKA TOMBOL "KIRIM BUKTI PEMBAYARAN" DIKLIK
        if(isset($_POST['kirim_pembayaran'])){
            $tgl_pembayaran   = date('Y-m-d');
            $metode_bayar     = $_POST['metode_pembayaran'];
            $status_pembayaran = "Pending"; 
            
            // Proses Upload Gambar Bukti Pembayaran
            $nama_file = $_FILES['bukti_pembayaran']['name'];
            $tmp_file  = $_FILES['bukti_pembayaran']['tmp_name'];
            
            // Enkripsi nama file agar unik dan tidak tabrakan di folder
            $bukti_pembayaran = time() . "_" . $nama_file;
            $path = "images/" . $bukti_pembayaran;
            
            if(move_uploaded_file($tmp_file, $path)){
                // Query INSERT langsung masuk ke tabel pembayaran di phpMyAdmin Anda
                $insert = mysqli_query($koneksi, "INSERT INTO pembayaran (tgl_pembayaran, metode_pembayaran, bukti_pembayaran, status_pembayaran, no_pemesanan) 
                          VALUES ('$tgl_pembayaran', '$metode_bayar', '$bukti_pembayaran', '$status_pembayaran', '$no_pemesanan')");
                
                if($insert){
                    // Otomatis update status pesanan utama menjadi Menunggu Verifikasi
                    mysqli_query($koneksi, "UPDATE pemesanan SET status_pemesanan='Menunggu Verifikasi' WHERE no_pemesanan='$no_pemesanan'");
                    
                    echo "<script>alert('Konfirmasi pembayaran berhasil dikirim!');</script>";
                    echo "<meta http-equiv='refresh' content='0 url=index.php?page=pembayaran'>";
                } else {
                    echo "<script>alert('Gagal menyimpan ke database: " . mysqli_error($koneksi) . "');</script>";
                }
            } else {
                echo "<script>alert('Gagal mengupload gambar bukti pembayaran.');</script>";
            }
        }

        // 3. CEK APAKAH USER SUDAH PERNAH KONFIRMASI PEMBAYARAN UNTUK PESANAN INI
        $cek_bayar = mysqli_query($koneksi, "SELECT * FROM pembayaran WHERE no_pemesanan='$no_pemesanan'");
        $sudah_bayar = mysqli_fetch_object($cek_bayar);
?>

<section class="ftco-section ftco-cart">
    <div class="container">
        <div class="row justify-content-center">
            
            <div class="col-md-6 ftco-animate mb-4">
                <div class="cart-list text-left" style="background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0px 0px 15px rgba(0,0,0,0.05); border: 1px solid #e2e2e2;">
                    <h4 class="mb-4 text-center" style="background: #82ae46; color: #fff; padding: 10px; border-radius: 4px;">Detail Tagihan</h4>
                    
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td><strong>No. Pemesanan</strong></td>
                                <td class="text-right text-success"><strong><?php echo $result->no_pemesanan ?></strong></td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal Transaksi</strong></td>
                                <td class="text-right"><?php echo date('d F Y', strtotime($result->tanggal_pemesanan)) ?></td>
                            </tr>
                            <tr>
                                <td><strong>Status Pesanan</strong></td>
                                <td class="text-right">
                                    <span class="badge badge-warning" style="background: #e67e22; color: #fff; padding: 5px 10px;">
                                        <?php echo $result->status_pemesanan ?>
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <hr>
                    <h5 class="mb-3">Rincian Belanjaan</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th class="text-center">Qty</th>
                                <th class="text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $detail = mysqli_query($koneksi, "SELECT a.*, b.nama_barang FROM pemesanan_detail a 
                                                              LEFT JOIN barang b ON a.kd_barang = b.kd_barang 
                                                              WHERE a.no_pemesanan='$result->no_pemesanan'");
                            if($detail){
                                while($result_detail = mysqli_fetch_object($detail)){
                                    ?>
                                    <tr>
                                        <td><?php echo $result_detail->nama_barang ?></td>
                                        <td class="text-center"><?php echo $result_detail->qty ?></td>
                                        <td class="text-right">Rp <?php echo number_format($result_detail->harga * $result_detail->qty) ?></td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                            <tr style="border-top: 2px solid #eee;">
                                <td><strong>Total Pembayaran</strong></td>
                                <td></td>
                                <td class="text-right text-success"><strong>Rp <?php echo number_format($result->total_pemesanan) ?></strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-md-5 ftco-animate">
                <div class="cart-list text-left" style="background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0px 0px 15px rgba(0,0,0,0.05); border: 1px solid #e2e2e2;">
                    <h4 class="mb-4 text-center" style="background: #2f3542; color: #fff; padding: 10px; border-radius: 4px;">Form Konfirmasi Bayar</h4>
                    
                    <?php if(!$sudah_bayar){ ?>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Pilih Metode Pembayaran</label>
                                <select name="metode_pembayaran" class="form-control" required>
                                    <option value="">-- Pilih Bank / E-Wallet --</option>
                                    <option value="bca">Transfer Bank BCA (Manual)</option>
                                    <option value="mandiri">Transfer Bank Mandiri (Manual)</option>
                                    <option value="e_wallet">Dana / OVO / GoPay</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label>Upload Bukti Pembayaran (.jpg / .png)</label>
                                <input type="file" name="bukti_pembayaran" class="form-control-file" required>
                            </div>

                            <button type="submit" name="kirim_pembayaran" class="btn btn-primary py-3 px-4 btn-block">
                                Kirim Bukti Pembayaran
                            </button>
                        </form>
                    <?php } else { ?>
                        <div class="alert alert-success text-center py-4" style="border-radius: 6px; background-color: #d4edda; border-color: #c3e6cb; color: #155724;">
                            <div style="font-size: 40px; margin-bottom: 10px;">✅</div>
                            <h5>Konfirmasi Berhasil!</h5>
                            <p class="mb-0">Bukti pembayaran Anda sudah tersimpan di database phpMyAdmin. Mohon tunggu proses verifikasi oleh admin toko kami.</p>
                        </div>
                    <?php } ?>

                </div>
            </div>

        </div>
    </div>
</section>

<?php
    } else {
        echo "<div class='container text-center py-5'><h3>Belum ada riwayat transaksi pembayaran.</h3></div>";
    }
} else {
    echo "<meta http-equiv='refresh' content='0 url=index.php?page=login'>";
}
?>