<?php //vars
//Panorama Social ID&Pw
$ldapUserCH="UserName";
$ldapUserPWPost="Password";

//init CURL
$curl = curl_init();

//CURL Options
curl_setopt_array($curl, array(

//OAUTH 2.0 URL
CURLOPT_URL => "https://social.univera.com.tr/oauth2/authorize",
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => "",
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 30,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

//required
CURLOPT_CUSTOMREQUEST => "POST",

//postfields
//Username and Password fields are required
CURLOPT_POSTFIELDS => "username=".$ldapUserCH."&
password=".$ldapUserPWPost."&
grant_type=password&
client_id=PanoramaSocial&
client_secret=7768B35B1C1347CCAD570D499EEA599A&

//optional
captcha_response=",

//x-www-form-urlencoded required
CURLOPT_HTTPHEADER => array(
"cache-control: no-cache",
"content-type: application/x-www-form-urlencoded"
),
));

//exec CURL with params
$response = curl_exec($curl);

//fetch error
$err = curl_error($curl);

//close connection
curl_close($curl);

//if there's no any error (like connection or API)
if (!$err)

{
//decode answer
$json = $response;
$obj = json_decode($json);
}