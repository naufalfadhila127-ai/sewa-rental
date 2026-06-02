<?php
if(isset($_SESSION['id_pelanggan'])){
    $id_pelanggan = $_SESSION['id_pelanggan'];
    
    // 1. MENGAMBIL DATA PEMESANAN TERBARU UNTUK DIPANTAU PENGIRIMANNYA
    $query_pengiriman = mysqli_query($koneksi, "SELECT * FROM pemesanan WHERE id_pelanggan='$id_pelanggan' ORDER BY tanggal_pemesanan DESC, no_pemesanan DESC LIMIT 1");
    
    if(mysqli_num_rows($query_pengiriman) > 0) {
        $result = mysqli_fetch_object($query_pengiriman);
?>

<section class="ftco-section ftco-cart">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 ftco-animate">
                
                <div class="text-center mb-4">
                    <h2>Status Pengiriman Pesanan</h2>
                    <p>Pantau status perlengkapan bayi Anda yang sedang diproses hingga sampai ke tujuan.</p>
                </div>
                
                <div class="cart-list text-left" style="background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0px 0px 15px rgba(0,0,0,0.05); border: 1px solid #e2e2e2;">
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h5>No. Pemesanan: <span class="text-success">#<?php echo $result->no_pemesanan ?></span></h5>
                        </div>
                        <div class="col-md-6 text-md-right">
                            <h5>Status: 
                                <span class="badge" style="background: #82ae46; color: white; padding: 6px 12px; font-size: 14px;">
                                    <?php 
                                    // Mengubah tampilan teks status agar lebih ramah dibaca pembeli
                                    if($result->status_pemesanan == 'Menunggu' || $result->status_pemesanan == 'Menunggu Verifikasi') {
                                        echo "Sedang Dikemas / Menunggu Verifikasi";
                                    } elseif($result->status_pemesanan == 'Lunas') {
                                        echo "Dalam Perjalanan Kurir";
                                    } else {
                                        echo $result->status_pemesanan;
                                    }
                                    ?>
                                </span>
                            </h5>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <div class="row my-5 text-center">
                        <div class="col-4">
                            <div style="font-size: 30px; filter: <?php echo ($result->status_pemesanan == 'Menunggu' || $result->status_pemesanan == 'Menunggu Verifikasi' || $result->status_pemesanan == 'Lunas' || $result->status_pemesanan == 'Selesai') ? 'none' : 'grayscale(100%)'; ?>">📦</div>
                            <small class="font-weight-bold text-success">Pesanan Dikemas</small>
                        </div>
                        <div class="col-4">
                            <div style="font-size: 30px; filter: <?php echo ($result->status_pemesanan == 'Lunas' || $result->status_pemesanan == 'Selesai') ? 'none' : 'grayscale(100%)'; ?>">🚚</div>
                            <small class="font-weight-bold <?php echo ($result->status_pemesanan == 'Lunas' || $result->status_pemesanan == 'Selesai') ? 'text-success' : 'text-muted'; ?>">Dalam Perjalanan</small>
                        </div>
                        <div class="col-4">
                            <div style="font-size: 30px; filter: <?php echo ($result->status_pemesanan == 'Selesai') ? 'none' : 'grayscale(100%)'; ?>">🏠</div>
                            <small class="font-weight-bold <?php echo ($result->status_pemesanan == 'Selesai') ? 'text-success' : 'text-muted'; ?>">Sampai Tujuan</small>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <h5 class="mb-3">Item yang Dikirim:</h5>
                    <table class="table">
                        <thead style="background-color: #f8f9fa;">
                            <tr>
                                <th>Nama Perlengkapan Bayi</th>
                                <th class="text-center">Jumlah (Qty)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $detail_kirim = mysqli_query($koneksi, "SELECT a.*, b.nama_barang FROM pemesanan_detail a 
                                                                    LEFT JOIN barang b ON a.kd_barang = b.kd_barang 
                                                                    WHERE a.no_pemesanan='$result->no_pemesanan'");
                            if($detail_kirim){
                                while($row_detail = mysqli_fetch_object($detail_kirim)){
                                    ?>
                                    <tr>
                                        <td><?php echo $row_detail->nama_barang ?></td>
                                        <td class="text-center"><?php echo $row_detail->qty ?> pcs</td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                    
                    <div class="alert alert-info mt-4 text-center mb-0" role="alert" style="background-color: #e3f2fd; border: none; color: #0d47a1;">
                        <strong>Informasi Pengiriman:</strong> Estimasi pengiriman untuk wilayah Pulau Bangka adalah 3-5 hari kerja (Gratis Ongkir).
                    </div>
                    
                </div>
                
            </div>
        </div>
    </div>
</section>

<?php
    } else {
        echo "<div class='container text-center py-5'><h3>Belum ada informasi pengiriman aktif.</h3></div>";
    }
} else {
    echo "<meta http-equiv='refresh' content='0 url=index.php?page=login'>";
}
?>