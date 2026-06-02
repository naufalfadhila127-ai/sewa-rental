<?php
if (!isset($_SESSION['id_pelanggan'])) {
    echo "<meta http-equiv='refresh' content='0 url=index.php?page=login'>";
    exit;
}

$id_pelanggan = $_SESSION['id_pelanggan'];
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    //Menghapus Barang dan Pelanggan kedalam keranjang
    $aksi = $_GET['aksi'];
    if ($aksi == "clear") {
        $kd_barang = $_GET['kd_barang'];
        mysqli_query($koneksi, "
            DELETE FROM keranjang WHERE id_pelanggan='$id_pelanggan' AND kd_barang='$kd_barang'
            ");
        echo "<meta http-equiv='refresh' content='0 url=index.php?page=keranjang'>";
        exit;
    }
    //Menambahkan Barang dan Pelanggan kedalam keranjang
    if($aksi == "add") {
        $kd_barang = $_GET['kd_barang'];
        $cek = mysqli_query($koneksi, "SELECT * FROM keranjang WHERE id_pelanggan = 
            '$id_pelanggan' AND kd_barang = '$kd_barang'");
        if (mysqli_num_rows($cek) > 0) {
            $data_keranjang = mysqli_fetch_assoc($cek);
            $qty_baru = $data_keranjang['qty'] + 1;
            mysqli_query($koneksi, "UPDATE keranjang SET qty = '$qty_baru' 
                WHERE id_pelanggan = '$id_pelanggan' AND kd_barang = '$kd_barang'");
        }else {
            mysqli_query($koneksi, "INSERT INTO keranjang (id_pelanggan, kd_barang, qty)
                VALUES ('$id_pelanggan', '$kd_barang', '1')
                ");
        }
        echo "<meta http-equiv='refresh' content='0 url=index.php?page=keranjang'>";
        exit;
    }

    if($aksi == "min") {
        $kd_barang = $_GET['kd_barang'];
        $cek = mysqli_query($koneksi, "SELECT * FROM keranjang 
            WHERE id_pelanggan = '$id_pelanggan' AND kd_barang = '$kd_barang'");

        if (mysqli_num_rows($cek) > 0) {
            $data_keranjang = mysqli_fetch_assoc($cek);
            if($data_keranjang['qty'] > 1){
                $qty_baru = $data_keranjang['qty'] - 1;
                mysqli_query($koneksi, "UPDATE keranjang SET qty = '$qty_baru' 
                    WHERE id_pelanggan = '$id_pelanggan' AND kd_barang = '$kd_barang'");
            }else{
                mysqli_query($koneksi, " DELETE FROM keranjang 
                    WHERE id_pelanggan = '$id_pelanggan' AND kd_barang = '$kd_barang'");
            }
        }
        echo "<meta http-equiv='refresh' content='0 url=index.php?page=keranjang'>";
        exit;
    }

    if ($aksi == "checkout") {
        //no pemesanan
        $query_last = mysqli_query($koneksi, "SELECT no_pemesanan as kd_terakhir FROM `pemesanan` 
            order by CAST(no_pemesanan AS UNSIGNED) DESC limit 1");
        $last = mysqli_fetch_assoc($query_last);
        if ($last['kd_terakhir'] != null) {
            $no_pemesanan = $last['kd_terakhir'] + 1;
        } else {
            $no_pemesanan = 1;
        }

        $tanggal_pemesanan = date("Y-m-d");
        mysqli_query($koneksi, "
            INSERT INTO pemesanan(
            no_pemesanan,
            tanggal_pemesanan,
            status_pemesanan,
            id_pelanggan
            )VALUES(
            '$no_pemesanan',
            '$tanggal_pemesanan',
            'Dikirim',
            '$id_pelanggan'
            )
            ");

        $data_keranjang = mysqli_query($koneksi, "
            SELECT keranjang.*, barang.*
            FROM keranjang
            JOIN barang ON keranjang.kd_barang = barang.kd_barang
            WHERE keranjang.id_pelanggan = '$id_pelanggan'
            ");
        $total_pemesanan =0;
        $detail ='';
        $i=1;
        while ($row = mysqli_fetch_assoc($data_keranjang)) {
            $kd_barang  = $row['kd_barang'];
            $qty        = $row['qty'];
            $harga      = $row['harga'];
            $total_pemesanan += ($qty * $harga);
            mysqli_query($koneksi, "
                INSERT INTO pemesanan_detail(
                no_pemesanan,
                kd_barang,
                qty,
                harga
                )
                VALUES(
                '$no_pemesanan',
                '$kd_barang',
                '$qty',
                '$harga'
                )");

            $detail = $detail.'*'.($i).' '. $row['nama_barang'].'*
            Jumlah: '. $qty.'
            Harga (x1): Rp. '. number_format($harga, '0', ',', '.'). '
            Harga Total: Rp.' .number_format($harga * $qty, '0', ',', '.') . '
            --------------------------------';
            $i++;
        }
        //update total_pemesanan
        mysqli_query($koneksi, "UPDATE pemesanan SET total_pemesanan = '$total_pemesanan' 
            WHERE no_pemesanan = '$no_pemesanan'");

        mysqli_query($koneksi, " DELETE FROM keranjang WHERE id_pelanggan = '$id_pelanggan'");

        //Kirim Whatsapp ke Admin
        $row_pelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan 
            WHERE id_pelanggan = '$id_pelanggan'");
        $data_pelanggan = mysqli_fetch_assoc($row_pelanggan);
        $alamat = $data_pelanggan['alamat_pelanggan'];
        $message = 'Halo Saya ingin order : 
        '.$detail.'
        Total: *Rp. ' . number_format($total_pemesanan, '0', ',', '.') . '*
        Nomor Pemesanan : *' . $no_pemesanan . '*
        -----------------------
            *Nama: * '. $_SESSION['nama_pelanggan'].' ('.$_SESSION['telp_pelanggan'].')
            *Alamat: *'.$alamat;
        $url = "https://api.whatsapp.com/send/?phone=6281368607715&text=" . urlencode($message);
        echo "<script>window.location.href='$url'</script>";
    }
}else{
    echo "<meta http-equiv='refresh' content='0 url=index.php?page=keranjang'>";
    exit;
}
?>