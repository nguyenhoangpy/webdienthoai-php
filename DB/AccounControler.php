<?php

use function PHPSTORM_META\elementType;

session_start();
require_once("DBControler.php");
$email = "";
$fullname = "";

//if user signup button
if (isset($_POST['signup'])) {
    $fullname = mysqli_real_escape_string($connection, $_POST['fullname']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    $repassword = mysqli_real_escape_string($connection, $_POST['repassword']);
    $phone = mysqli_real_escape_string($connection, $_POST['phone']);
    if ($email == ""  || $password == "" || $repassword == "" || $phone == "" || $fullname == "") {
        echo "<script>alert('Vui lòng nhập đầy đủ thông tin!');</script>";
    } else {
        $email_check = "select * from user where email='$email'";
        $res_mail = mysqli_query($connection, $email_check);
        $phone_check = "select * from user where phone='$phone'";
        $res_phone = mysqli_query($connection, $phone_check);
        if ($res_mail->num_rows > 0) {
            echo "<script>alert('Email đã được đăng ký trước đó!');</script>";
        } else if ($res_phone->num_rows > 0) {
            echo "<script>alert('Số điện thoại đã được đăng ký trước đó!');</script>";
        } else if ($password != $repassword) {
            echo "<script>alert('Mật khẩu không trùng khớp!');</script>";
        } else {
            $code = rand(999999, 111111);
            $status = "notverified";
            $sql = "insert into user (full_name,password,email,code,phone,status) values('$fullname','$password','$email','$code','$phone','$status')";
            $data_check = mysqli_query($connection, $sql);
            if ($data_check) {
                $subject = "Email Verification Code";
                $message = "Your verification code is $code";
                if (mail($email, $subject, $message)) {
                    $_SESSION['email'] = $email;
                    $_SESSION['password'] = $password;
                    header('location: verifi_email.php');
                    exit();
                } else {
                    echo "<div class='alert alert-danger' role='alert'>Gửi mail xác nhận thất bại</div>";
                }
            }
        }
    }
}
//if user click verification code submit button
if (isset($_POST['checkcode_signup'])) {
    $_SESSION['info'] = "";
    $otp_code = mysqli_real_escape_string($connection, $_POST['otp']);
    $check_code = "SELECT * FROM user WHERE code = $otp_code";
    $code_res = mysqli_query($connection, $check_code);
    if ($code_res->num_rows > 0) {
        $fetch_data = mysqli_fetch_assoc($code_res);
        $fetch_code = $fetch_data['code'];
        $email = $fetch_data['email'];
        $code = 0;
        $status = 'verified';
        $update_otp = "UPDATE user SET code = $code, status = '$status' WHERE code = $fetch_code";
        $update_res = mysqli_query($connection, $update_otp);
        if ($update_res) {
            $_SESSION['fullname'] = $fullname;
            $_SESSION['email'] = $email;
            header('location: login.php');
            exit();
        } else {
            echo "<div class='alert alert-danger' role='alert'>Xác minh thất bại!</div>";
        }
    } else {
        echo "<div class='alert alert-danger' role='alert'>Mã xác minh không chính xác!</div>";
    }
}

//if user click login button
if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    if ($email == "" || $password == "") {
        echo "<script>alert('Vui lòng nhập đầy đủ thông tin!');</script>";
    } else {
        $check_email = "SELECT * FROM user WHERE email = '$email' and password='$password'";
        $res = mysqli_query($connection, $check_email);
        if ($res->num_rows > 0) {
            $fetch = mysqli_fetch_assoc($res);
            $status = $fetch['status'];
            $code = $fetch['code'];
            if ($status == "notverified") {
                //$_SESSION['email'] = $fetch['email'];                
                $subject = "Email Verification Code";
                $message = "Your verification code is $code";
                if (mail($email, $subject, $message)) {
                    $_SESSION['email'] = $email;
                    header('location: verifi_email.php');
                    exit();
                } else {
                    echo "<script>alert('Gửi mail xác nhận thất bại!');</script>";
                }
                //header('location: verifi_email.php');
            } else if ($status == "verified") {
                $_SESSION['userid'] = $fetch['user_id'];
                $_SESSION['email'] = $fetch['email'];
                $_SESSION['fullname'] = $fetch['full_name'];
                $_SESSION['phone'] = $fetch['phone'];
                header("Location: index.php");
            }
        } else {
            echo "<script>alert('Tài khoản hoặc mật khẩu không chính xác!');</script>";
        }
    }
}

//if user click continue button in forgot password form
if (isset($_POST['forgotpwd'])) {
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $check_email = "SELECT * FROM user WHERE email='$email'";
    $run_sql = mysqli_query($connection, $check_email);
    if ($run_sql->num_rows > 0) {
        $code = rand(999999, 111111);
        $insert_code = "UPDATE user SET code = $code WHERE email = '$email'";
        $run_query =  mysqli_query($connection, $insert_code);
        if ($run_query) {
            $subject = "Password Reset Code";
            $message = "Your password reset code is $code";
            if (mail($email, $subject, $message)) {

                $_SESSION['email'] = $email;
                header('location: check_reset.php');
                exit();
            } else {
                echo "<div class='alert alert-danger' role='alert'>Gửi email xác minh thất bại!</div>";
            }
        } else {
            echo "<div class='alert alert-danger' role='alert'>Có gì đó không đúng!</div>";
        }
    } else {
        echo "<div class='alert alert-danger' role='alert'>Email không tồn tại!</div>";
    }
}

//if user click check reset otp button
if (isset($_POST['checkcode_reset'])) {
    $_SESSION['info'] = "";
    $otp_code = mysqli_real_escape_string($connection, $_POST['otp']);
    $check_code = "SELECT * FROM user WHERE code = $otp_code";
    $code_res = mysqli_query($connection, $check_code);
    if ($code_res->num_rows > 0) {
        $fetch_data = mysqli_fetch_assoc($code_res);
        $email = $fetch_data['email'];
        $_SESSION['email'] = $email;

        header('location: new_pwd.php');
        exit();
    } else {
        echo "<div class='alert alert-danger' role='alert'>Mã xác minh không chính xác!</div>";
    }
}

//if user click change password button
if (isset($_POST['change-password'])) {
    $_SESSION['info'] = "";
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    $repassword = mysqli_real_escape_string($connection, $_POST['repassword']);
    if ($password !== $repassword) {
        echo "<script>alert('Mật khẩu không trùng khớp!');</script>";
    } else {
        $code = 0;
        $email = $_SESSION['email']; //getting this email using session
        // $encpass = password_hash($password, PASSWORD_BCRYPT);
        $update_pass = "UPDATE user SET code = $code, password = '$password' WHERE email = '$email'";
        $run_query = mysqli_query($connection, $update_pass);
        if ($run_query) {
            echo "<script>alert('Đổi mật khẩu thành công!');</script>";
            header('Location: login.php');
        } else {
            echo "<div class='alert alert-danger' role='alert'>Khôi phục thất bại</div>";
        }
    }
}
