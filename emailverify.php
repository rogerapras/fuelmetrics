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
        
        echo "
            We've just sent a verifcation email to $to&#46;<br /> 
            It was sent from noreply@fuelmetrics.org. If you dont<br />  
            see it in your inbox within the next few minutes,<br />  
            check to see if a spam filter or email rule moved the<br />  
            email, it might be in the Spam, Junk, Trash, Deleted<br />  
            Items, or Archive folder.<br /> 
        ";
?>
    </body>
</html>
