<?php

//post to a personal page or group
//Panorama Social Page ID
$pageID = 1234;
$data = "Hi, Univera!";

//decode json source, connection.php provides
$obj = json_decode($json);

//take token from json
$tokenSocial = $obj->{'access_token'}; // 123456
//if provided, start posting
if (isset($tokenSocial)) {

//auth Bearer key + token
$utoken = "Authorization: Bearer " . $tokenSocial . "";

//generate params
$curlParam = "pageId=$pageID&Text=$data";

//init
$curl = curl_init();

//options
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://social.univera.com.tr/api/PostService/SendPost",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            
        //send params with postfields
        CURLOPT_POSTFIELDS => $curlParam,
            
        //post opt required
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "content-type: application/x-www-form-urlencoded",
            
            //add token to the header
            $utoken),
    ));
    $result = curl_exec($curl);

    if (!$result) {
        die("Connection Failure");
    }
    curl_close($curl);
}

