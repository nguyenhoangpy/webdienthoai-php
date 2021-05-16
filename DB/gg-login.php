<?php
require_once("DBControler.php");
include_once("./Google/vendor/autoload.php");
if (session_status() === PHP_SESSION_NONE) {
   session_start();
}
$google_client = new Google_Client();
$google_client->setClientId('1046941357707-6j19u1qritktvdhv96n5lau20piitp1l.apps.googleusercontent.com');
$google_client->setClientSecret('Qfxxw7WGM0S7V4SvtA8xzZnH');

$google_client->setRedirectUri('https://site.com/24h/');

$google_client->addScope('email');
$google_client->addScope('profile');

if (isset($_GET["code"])) {
    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
    if (!isset($token['error'])) {
        $google_client->setAccessToken($token['access_token']);
        $_SESSION['access_token'] = $token['access_token'];
        $google_service = new Google_Service_Oauth2($google_client);
        $data = $google_service->userinfo->get();
        if (!empty($data)){
            $sql_check = "select * from user where email='".$data['email']."'";
            $sql_add = " insert into user(full_name, email, status) values ('".$data['given_name']."','".$data['email']."','verified')";
            //$connection-> query("SET NAMES utf8");
            $result = mysqli_query($connection, $sql_check);
            if($result->num_rows == 0 ){
                $res = mysqli_query($connection, $sql_add);
                
            }
            while ($row = mysqli_fetch_array($result)) {
                $_SESSION['fullname'] = $row['full_name'];
                $_SESSION['userid'] = $row['user_id'];
                $_SESSION['email'] = $row['email'];
            }
        }      
    }
}
if (!isset($_SESSION['access_token'])) {
    $google_login_url = $google_client->createAuthUrl();
}
