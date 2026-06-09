<?php
    define('API', 'restAPI.php'); // NICHT VERAENDERN!!!
    $url = "http://localhost/bikerental/" . API;


/**
 * Options for show all available bikes
 */
    $defaults = array(
        CURLOPT_URL => $url . '/booking/showBikesForBooking?start=2026-06-24&duration=7&storeLocationId=1cb28278-d28a-11e7-b93f-2c4d544f8fe0&type=Trekkingrad',
        CURLOPT_CUSTOMREQUEST => "GET"
    );

/**
 * Options for update a bike
 */
//     $params = json_encode(array(
//         'bikeNo' => 'E002'
//         , 'damage' => 'Kratzer am Rahmen; Frontreflektor fehlt'));
//     $defaults = array(
//         CURLOPT_URL => $url . '/bike/c70496bd-df64-11f0-9846-fc3497bf08e3',
//         CURLOPT_CUSTOMREQUEST => "PUT",
//         CURLOPT_POSTFIELDS => $params
//     );

/**
 * Options for insert a new bike
 */
//     $params = json_encode(array(
//         'bikeTypeId' => 'e354b6c4-df64-11f0-9846-fc3497bf08e3'
//         , 'storeLocationId' => '1cb28278-d28a-11e7-b93f-2c4d544f8fe0'
//         , 'bikeNo' => 'TR03'));
//     $defaults = array(
//         CURLOPT_URL => $url . '/bike',
//         CURLOPT_CUSTOMREQUEST => "POST",
//         CURLOPT_POSTFIELDS => $params
//     );

    
/**
 * Options for delete customer
 */
//     $defaults = array(
//         CURLOPT_URL => $url . '/customer/0236c075-df64-11f0-9846-fc3497bf08e3',
//         CURLOPT_CUSTOMREQUEST => "DELETE"
//     );

    $ch = curl_init();
    curl_setopt_array($ch, ($defaults));
    curl_exec($ch);
    if(curl_error($ch)) {
        print(curl_error($ch));
    }
    curl_close($ch);
?>