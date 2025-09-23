<?php session_start(); ?> 
<?php
include "../../koneksi.php";
$api_key = "4aecd64265f0426f99899087c0b058d3";

function hitung_ongkir($kota_asal, $kota_tujuan, $kurir, $berat, $key)
{
    $curl = curl_init();

    $post_fields = [
        "origin" => $kota_asal,
        "origin_type" => "city",
        "destination" => $kota_tujuan,
        "destination_type" => "city",
        "weight" => $berat,
        "courier" => $kurir
    ];

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://rajaongkir.komerce.id/api/v1/cost",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode($post_fields),
        CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
            "Key: " . $key
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    $data = ['status' => false, 'result' => ''];

    if ($err) {
        $data['result'] = $err;
    } else {
        $result = json_decode($response, true);
        if (isset($result['meta']['code']) && $result['meta']['code'] == 200) {
            $data['status'] = true;
            $data['result'] = $result['data'][0];
        } else {
            $data['result'] = isset($result['meta']['message']) ? $result['meta']['message'] : 'Error';
        }
    }
    return $data;
}
?>
<?php
if (isset($_GET['city_destination'])){
    $kota_tujuan = $_GET['city_destination'];
    $kota_asal='419'; /* Sleman */
    $kurir = 'pos';
    $berat = 25000;

    $ongkir = hitung_ongkir($kota_asal,$kota_tujuan,$kurir,$berat,$api_key);

    if (isset($ongkir['result']['costs'][1]['cost'][0]['value'])) {
        $hasil = $ongkir['result']['costs'][1]['cost'][0]['value'];
    } elseif (isset($ongkir['result']['costs'][0]['cost'][0]['value'])) {
        $hasil = $ongkir['result']['costs'][0]['cost'][0]['value'];
    } else {
        $hasil = 0;
    }

    $subtotal = (int)$_GET['subtotal'];
    $total =  $hasil + $subtotal;

    echo $total;
} else {
    echo 0;
}
?>