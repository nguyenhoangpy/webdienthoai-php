<?php
session_start();
if (!isset($_SESSION['userid'])){
    header("Location: index.php");
}
session_destroy();
unset($_SESSION['userid']);
unset($_SESSION['access_token']);
header("Location: index.php");
?>