<?php

$key = "4aecd64265f0426f99899087c0b058d3";
$city_id = isset($_GET['id']) ? $_GET['id'] : '';

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://rajaongkir.komerce.id/api/v1/destination/district/" . $city_id,
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
    $districts = [];
    if (isset($data['data'])) {
        foreach ($data['data'] as $district) {
            $districts[] = [
                'district_id' => $district['id'],
                'district_name' => $district['name'],
                'zip_code' => $district['zip_code']
            ];
        }
    }

    $rajaongkir_response = [
        'rajaongkir' => [
            'query' => [ 'city' => $city_id ],
            'status' => [
                'code' => isset($data['meta']['code']) ? $data['meta']['code'] : 500,
                'description' => isset($data['meta']['message']) ? $data['meta']['message'] : 'Error'
            ],
            'results' => $districts
        ]
    ];

    echo json_encode($rajaongkir_response);
}
