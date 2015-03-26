<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $to = $_SESSION['email'];
        $link = $_SESSION['link'];
        $subject = "New Account Verification";

        $message = "
        <html>
        <head>
        <title>FuelMetrics.org New Account Verification</title>
        </head>
        <body>
        <br />
        <a href='http://fuelmetrics.org/' ><img alt='logo' src='http://test.fuelmetrics.org/images/emaillogo.png' /></a><br /><br /><br />
        <hr /><br /><br />
        Hello and welcome to FuelMetrics,<br /><br />
        Your FuelMetrics.org account is waiting for you! One more step will
        verify your account so you can start tracking your auto fuel consumption
        and expenditures with our free and easy to use set of tools and charts.<br /><br />
        Click the URL below or copy and paste it into your browser to confirm your
        E-mail address and start using FuelMetrics.org.<br /><br /><br />
        http://fuelmetrics.org/verify.php?activationkey=$link<br /><br /><br />
        <hr /><br /><br />
        [ $to ] will now be your official FuelMetrics sign-in ID, which you
        will be able to use for logging in to your account.<br /><br />
        Thanks!<br /><br />
        &nbsp;&nbsp;&nbsp;-The FuelMetrics.org team<br /><br />
        </body>
        </html>
        ";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <noreply@fuelmetrics.org>' . "\r\n";
        //$headers .= 'Cc: email@example.com' . "\r\n";

        mail($to,$subject,$message,$headers);
        echo "
            We've just sent a verifcation email to $to&#46; 
            It was sent from noreply@fuelmetrics.org. If you dont 
            see it in your inbox within the next few minutes, 
            check to see if a spam filter or email rule moved the 
            email, it might be in the Spam, Junk, Trash, Deleted 
            Items, or Archive folder.
        ";
?>
    </body>
</html>
