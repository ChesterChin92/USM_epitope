<?php
session_start();

include '../includes/emicodb_conn.php';
//Disable error suppression @ when debug


echo "Ur email!".$_POST["username"].";";
echo "<br/>";
echo "Ur password!".$_POST["password"].";";
echo "<br/>";


$username = filter_has_var(INPUT_POST, 'username') ? $_POST['username'] : null;
$username = filter_var($username, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
$username = filter_var($username, FILTER_SANITIZE_SPECIAL_CHARS);
$username = strip_tags($username );
//$username = mysqli_real_escape_string($conn,$username);

$password = filter_has_var(INPUT_POST, 'password') ? $_POST['password'] : null;
$password = filter_var($password, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
$password = filter_var($password, FILTER_SANITIZE_SPECIAL_CHARS);
$password = strip_tags($password );
//$password = mysqli_real_escape_string($conn,$password);


$lg_query = "SELECT user_ID,email,display_name FROM emico.user where email='".$username."' and password ='".$password."';";
$result = mysqli_query($con,$lg_query) or die(mysqli_error($con));

if( $con === FALSE )
{
    $_SESSION['login_status'] = "fail";
    // You can replace this with any other error handling you'd like.
//    header( "Location: ../html/login.php" );
//    die();
}

//Login Details Match
if(mysqli_num_rows($result)>0){
    while ($row = mysqli_fetch_array($result))
    {
        if ($row["user_ID"] == "11"){
            $_SESSION['username']= $row["username"];
//            $_SESSION['admin']= "TRUE";
//            $_SESSION['userid']= $row["userid"];
            $_SESSION['email'] = $row["email"];
//            header("Location: ../html/order_ref.php");
            exit;
        }
        else{
            $_SESSION['display_name']= $row["display_name"];
//            $_SESSION['userid']= $row["userid"];
//            $_SESSION['admin']= "FALSE";
            $_SESSION['email'] = $row["email"];
            header("Location: ../production/index.php");
            exit;
        }
    }
}

//Login Details Not match
else
{
    $_SESSION['login_status'] = "fail";
    var_dump(isset($_SESSION['username']));
    var_dump($_SESSION);
    var_dump($_SESSION['login_status']);
    header("Location: ../index.php");
    exit;
}
//For debug
//var_dump($_SESSION['login']);
//var_dump($_SESSION['login_status']);
?>