<?php
use Facebook\Facebook;
include_once("./Facebook/autoload.php");
require_once("DBControler.php");
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$facebook = new Facebook([
    'app_id' => '137004188416494',
    'app_secret' => '717a12d4bd1965ede64eba3efe4c39e3',
    'default_graph_version' => 'v3.2',
]);

$facebook_helper = $facebook->getRedirectLoginHelper();

if (isset($_GET['state'])) {
    $facebook_helper->getPersistentDataHandler()->set('state', $_GET['state']);
    if (isset($_SESSION['access_token'])) {
        $access_token = $_SESSION['access_token'];
    } else {
        $access_token = $facebook_helper->getAccessToken();

        $_SESSION['access_token'] = $access_token;
        $facebook->setDefaultAccessToken($_SESSION['access_token']);
    }
    $graph_reponse = $facebook->get("/me?fields=name,email", $access_token);
    $facebook_user_info = $graph_reponse->getGraphUser();
    // if (!empty($facebook_user_info['name'])) {
    //     $_SESSION['fullname'] = $facebook_user_info['name'];
    // }
    // if (empty($facebook_user_info['email'])) {
    //     $facebook_user_info['email'] = '';
    // }
    if (!empty($facebook_user_info)){
        $sql_check = "select * from user where email='".$facebook_user_info['email']."'";
        $sql_add = " insert into user(full_name, email, status) values ('".$facebook_user_info['name']."','".$facebook_user_info['email']."','verified')";
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
} else {
    $facebook_permissions = ['email'];
    $facebook_login_url = $facebook_helper->getLoginUrl('https://site.com/24h/', $facebook_permissions);
}


