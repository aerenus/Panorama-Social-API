<?php

//get user info

//decode json source, connection.php provides
$obj = json_decode($json);

//take token from json
$tokenSocial = $obj->{'access_token'}; // 123456

//if provided, start posting
if (isset($tokenSocial)) {

//auth Bearer + Key
$utoken = "Authorization: Bearer " . $tokenSocial . "";

//init
$curl = curl_init();

        curl_setopt_array($curl, array(
        //using SearchUsers API under UserSevice
        //this API will provide all user info and hierarchy
        //SearchUsers will not list requested user
        CURLOPT_URL => "https://social.univera.com.tr/api/UserService/SearchUsers?searchText=",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            
        //type GET required
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "content-type: application/x-www-form-urlencoded",
            $utoken),
    ));
        
    //exec
    $result = curl_exec($curl);

    if (!$result) {
        die("Connection Failure");
    }

    curl_close($curl);
    
    //decode 
    $arr = json_decode($result, true);

    //inside keys
    foreach ($arr as $object) {

        //getdata
        foreach ($object as $value) {

            //maxUserId is a local value
            if ($value[PersonalPageId] > $maxUserId) {
                
                //vars
                $valPersonalPID = $value[PersonalPageId];
                $valUserName = $value[UserName];

                //insert data to MySQL table
                $sqlInsert = "INSERT INTO `socialpageindex` (`PersonalPageId`, `UserName`)
                VALUES ('$valPersonalPID', '$valUserName');";
                
                //$conn is a MySQL define
                $insertSorgu = $conn->query($sqlInsert);
            }
        }
    }
}
