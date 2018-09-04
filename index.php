<?php
session_start();

$msg = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    print_r($_REQUEST);
    exit;
    $msg = "";
    $recaptcha = $_POST['g-recaptcha-response'];
    if (!empty($recaptcha)) {
        include("getinformation.php");
        $google_url = "https://www.google.com/recaptcha/api/siteverify";
        $secret = '6LcD4TEUAAAAAMg6JLWTEhHtm2s2dzo5U22HNGXP';
        $ip = $_SERVER['REMOTE_ADDR'];
        $url = $google_url . "?secret=" . $secret . "&response=" . $recaptcha;
        $res = getCurlData($url);
        $res = json_decode($res, true);
        print_r($res);exit;
        if ($res['success']) {
            $msg =  "Successs......";
        } else {
            $msg = "Please re-enter your reCAPTCHA.";
        }
    } else {
        $msg = "Please re-enter your reCAPTCHA.";
    }
}
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>True vista</title>
        <script src='https://www.google.com/recaptcha/api.js'></script>
    </head>
    <body>
        <?php if(isset($msg) && $msg != ""){echo $msg;}?>
        <div id="main">
            <h1></h1>
            <div id="box">
                <form action="" method="post">
                    <label>Username</label> <input type="text" name="username" class="input" />
                    <label>Password </label><input type="password" name="password" class="input" />
                    <br/><br/>
                    <div class="g-recaptcha" data-sitekey="6LcD4TEUAAAAAMXIa7jlM7jfbd8ajsfyCFxJEvMx"></div>
                    <br/>
                    <input type="submit" class="button button-primary" value="Log In" id="login"/>

                    <span class='msg'><?php echo $msg; ?></span>
                </form>
            </div>
        </div>
    </body>
</html>