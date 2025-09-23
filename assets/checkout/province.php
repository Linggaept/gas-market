<?php

$key = "4aecd64265f0426f99899087c0b058d3";

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://rajaongkir.komerce.id/api/v1/destination/province",
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
    $provinces = [];
    if (isset($data['data'])) {
        foreach ($data['data'] as $province) {
            $provinces[] = [
                'province_id' => $province['id'],
                'province' => $province['name']
            ];
        }
    }

    $rajaongkir_response = [
        'rajaongkir' => [
            'query' => [],
            'status' => [
                'code' => isset($data['meta']['code']) ? $data['meta']['code'] : 500,
                'description' => isset($data['meta']['message']) ? $data['meta']['message'] : 'Error'
            ],
            'results' => $provinces
        ]
    ];

    echo json_encode($rajaongkir_response);
}
