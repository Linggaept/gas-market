<?php
    $api_key = "0883ec8a5f6e44e371d727df3c0b3241";

    function get_province($key){
        $data = [
            'status' => false,
            'result' => []
        ]; 
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
            $data['result'] = $err;
        } else {
            $result = json_decode($response, true);
            if (isset($result['meta']['code']) && $result['meta']['code'] == 200){
                $data['status'] = true;
                $data['result'] = $result['data'];
            } else {
                $data['result'] = isset($result['meta']['message']) ? $result['meta']['message'] : 'Error';
            }
        }
        return $data;
    }

    function get_city($province_id, $key){
        $data = [
            'status' => false,
            'result' => []
        ]; 
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
            $data['result'] = $err;
        } else {
            $result = json_decode($response, true);
            if (isset($result['meta']['code']) && $result['meta']['code'] == 200){
                $data['status'] = true;
                $data['result'] = $result['data'];
            } else {
                $data['result'] = isset($result['meta']['message']) ? $result['meta']['message'] : 'Error';
            }
        }
        return $data;
    }

    function hitung_ongkir($kota_asal, $kota_tujuan, $kurir, $berat, $key){
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
            if (isset($result['meta']['code']) && $result['meta']['code'] == 200){
                $data['status'] = true;
                $data['result'] = $result['data'][0];
            } else {
                $data['result'] = isset($result['meta']['message']) ? $result['meta']['message'] : 'Error';
            }
        }
        return $data;
    }

    function get_district($city_id, $key){
        $data = [
            'status' => false,
            'result' => []
        ]; 
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
            $data['result'] = $err;
        } else {
            $result = json_decode($response, true);
            if (isset($result['meta']['code']) && $result['meta']['code'] == 200){
                $data['status'] = true;
                $data['result'] = $result['data'];
            } else {
                $data['result'] = isset($result['meta']['message']) ? $result['meta']['message'] : 'Error';
            }
        }
        return $data;
    }

    function hitung_ongkir_district($origin_district, $destination_district, $weight, $courier, $key){
        $curl = curl_init();

        $post_fields = http_build_query([
            'origin' => $origin_district,
            'destination' => $destination_district,
            'weight' => $weight,
            'courier' => $courier,
            'price' => 'lowest'
        ]);

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://rajaongkir.komerce.id/api/v1/calculate/district/domestic-cost",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => $post_fields,
          CURLOPT_HTTPHEADER => array(
            "Content-Type: application/x-www-form-urlencoded",
            "key: " . $key
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
            if (isset($result['meta']['code']) && $result['meta']['code'] == 200){
                $data['status'] = true;
                $data['result'] = $result['data'];
            } else {
                $data['result'] = isset($result['meta']['message']) ? $result['meta']['message'] : 'Error';
            }
        }
        return $data;
    }
?>