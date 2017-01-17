<?php

//session_start();
//include '../includes/cpdb_conn.php';
//$_SESSION['event_reg_stat'] = "";
//
//if (isset($_GET['email'])) {
//    $address = $_GET['email'];
//
//} else {
//    $_SESSION['event_signup_stat'] = "Error in email provided";
//    header("Location: ../html/signup.php");
//    exit;
//}
//
//
//$check_email_sql = "SELECT userid,username,email FROM swe_db.user WHERE email = '" . $address . "';";
//
//if ($result_wait_list = mysqli_query($conn, $check_email_sql)) {
//    while ($row = mysqli_fetch_assoc($result_wait_list)) {
//        $_SESSION['event_reg_stat'] = "Email already being used, try a new email.";
//        header("Location: ../html/signup.php");
//        exit;
//    }
//} else {
//    echo "Error INSERTING record: " . mysqli_error($conn);
//    $_SESSION['event_reg_stat'] = "Error in check email sql.";
//    header("Location: ../html/signup.php");
//    exit;
//}
//
//if (isset($_GET['password']) and isset($_GET['password_rt'])) {
//    $pw = $_GET['password'];
//    $pw_rt = $_GET['password_rt'];
//
//    if ($pw == $pw_rt) {
//        echo "OK";
//    } else {
//        $_SESSION['event_reg_stat'] = "Both password does not match!";
//        header("Location: ../html/signup.php");
//        exit;
//    }
//
//} else {
//    echo "Something wrong in getting password and password_rt";
//    $_SESSION['event_reg_stat'] = "Error in GET password and password_rt";
//    header("Location: ../html/signup.php");
//    exit;
//}


require_once('../phpmailer/class.phpmailer.php');
require_once('../phpmailer/PHPMailerAutoload.php'); //Loads necessary resource incase class.phpmailer.pjp didnt load all resource
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

$mail = new PHPMailer();

$body = file_get_contents('report.html');
//$body             = eregi_replace("[\]",'',$body);

$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host = "smtp.gmail.com"; // SMTP server
//$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
// 1 = errors and messages
// 2 = messages only
$mail->SMTPAuth = true;                  // enable SMTP authentication
$mail->SMTPSecure = "tls";                 // sets the prefix to the servier
$mail->Host = "smtp.gmail.com";      // sets GMAIL as the SMTP server
$mail->Port = 587;                   // set the SMTP port for the GMAIL server
$mail->Username = "@gmail.com";  // GMAIL username
$mail->Password = "@prod";            // GMAIL password

$mail->SetFrom('@gmail.com', 'Report');

//$mail->AddReplyTo("chinschian@hotmail.com","Chester");

if (isset($_GET['f_name'])) {
//    echo "Mailer Error: " . $mail->ErrorInfo;
    $mail->Subject = "Production Report -" . $_GET['f_name'] . $_GET['email'] . $_GET['password'];
} else {
    $mail->Subject = "Production Report ";
//    echo "Message sent!";
}


$mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

$mail->MsgHTML($body);


if (isset($_GET['email'])) {
    $address = $_GET['email'];
    $mail->AddAddress($address, $_GET['f_name']);
} else {
    $address = "chinschian@hotmail.com";
    $mail->AddAddress($address, "Chester Chin");


    echo "Message sent!";
}

//$mail->AddAttachment("images/phpmailer.gif");      // attachment
//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

if (!$mail->Send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";

    //$reg_query = "INSERT INTO `swe_db`.`user` (`username`, `email`, `password`, `age`) VALUES ('" . $_GET['f_name'] . "', '" . $_GET['email'] . "', '" . $_GET['password'] . "', '100');";
    //include '../includes/swedb_conn.php';
    //Disable error suppression @ when debug
    //@mysqli_query($con, $reg_query) or die(mysqli_error($con));

    //header("Location: ../html/login.php");
}
?>