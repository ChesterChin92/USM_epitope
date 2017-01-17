<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width">
    <title>Emico Web</title>
    <?php require_once('includes/helpers.php'); ?>
    <?php echo loadResources(array('css/nav.css', 'css/login.css', 'css/toastr.css'),
        array('js/functions.js', 'js/jquery.min.js', 'js/toastr.js')) ?>
    <?php check_session() ?>
</head>
<body>


<?php include './includes/emicodb_conn.php'; ?>


<div class="image" style=" margin: auto auto;">
    <img src="images/logo.jpg">
</div>
<div class="wrapper">
    <!--    Sign up Page, more content soon.-->
    <div class="form">
        <h1>Login</h1>
        <form action="./controller/proc_signin.php" method="post">

            <div class="field-wrap">
                <label>
                    Email Address<span class="req">*</span>
                </label>
                <input name="username" type="email" required autocomplete="off"/>
            </div>

            <div class="field-wrap">
                <label>
                    Password<span class="req">*</span>
                </label>
                <input name="password" type="password" required autocomplete="off"/>
            </div>

            <br/>

            <button type="submit" class="button button-block">
                Login
            </button>
            <br/>

        </form>
    </div>
</div>


</body>
</html>


