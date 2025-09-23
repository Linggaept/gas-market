<?php
session_start();
include "../../koneksi.php";
include "../api/rajaongkir.php";

$api_key = "4aecd64265f0426f99899087c0b058d3";

if (isset($_GET['district_destination'])) {
    // Get origin district from settings
    $origin_query = mysqli_query($db, "SELECT nilai_pengaturan FROM tbl_pengaturan WHERE nama_pengaturan = 'origin_district'");
    $origin_row = mysqli_fetch_assoc($origin_query);
    $origin_district = $origin_row ? $origin_row['nilai_pengaturan'] : '1391'; // Fallback to default if not set

    $destination_district = $_GET['district_destination'];
    $courier = 'jne:sicepat:ide:sap:jnt:ninja:tiki:lion:anteraja:pos:ncs:rex:rpx:sentral:star:wahana:dse';
    
    // Calculate total weight from cart
    $total_berat = 0;
    if (!empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $id_produk => $jumlah) {
            $query = "SELECT berat FROM tbl_produk WHERE id_produk='$id_produk'";
            $result = mysqli_query($db, $query);
            if($result && mysqli_num_rows($result) > 0){
                $produk = mysqli_fetch_assoc($result);
                $total_berat += $produk['berat'] * $jumlah;
            }
        }
    }
    // Weight in grams. API expects grams.
    $berat = ($total_berat > 0) ? $total_berat : 1000;


    $ongkir_data = hitung_ongkir_district($origin_district, $destination_district, $berat, $courier, $api_key);

    $hasil = 0;
    if ($ongkir_data['status'] && !empty($ongkir_data['result'])) {
        // API with 'price=lowest' should return the cheapest option first.
        $hasil = $ongkir_data['result'][0]['cost'];
    }
    echo $hasil;
} else {
    echo 0;
}
?>