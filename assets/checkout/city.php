<?php

$key = "4aecd64265f0426f99899087c0b058d3";
$province_id = isset($_GET['id']) ? $_GET['id'] : '';

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://rajaongkir.komerce.id/api/v1/destination/city/" . $province_id,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "accept: application/json",
        "Key: " . $key
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    $data = json_decode($response, true);
    $cities = [];
    if (isset($data['data'])) {
        foreach ($data['data'] as $city) {
            $cities[] = [
                'city_id' => $city['id'],
                'province_id' => $province_id,
                'province' => '', // New API doesn't return province name here
                'type' => '', // 'type' is not available in the new API response
                'city_name' => $city['name'],
                'postal_code' => isset($city['zip_code']) ? $city['zip_code'] : ''
            ];
        }
    }

    $rajaongkir_response = [
        'rajaongkir' => [
            'query' => [ 'province' => $province_id ],
            'status' => [
                'code' => isset($data['meta']['code']) ? $data['meta']['code'] : 500,
                'description' => isset($data['meta']['message']) ? $data['meta']['message'] : 'Error'
            ],
            'results' => $cities
        ]
    ];

    echo json_encode($rajaongkir_response);
}