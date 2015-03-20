<!DOCTYPE html>
<?php session_start(); ?>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $_SESSION['signupPage'] = true;
        $_SESSION['loginPage'] = false;
        include_once './header.php';
        
        if (!empty($_POST)) {
            $email = filter_input(INPUT_POST, 'email');
        } else {
            $email = "";
        }
        ?>
        <h1>FuelMetrics.org Account Sign-up</h1>
        <form action="signupverify.php" method="post">
            <?php
            if (!empty($emailErrorMessage)) {
                echo $emailErrorMessage;
            }
            ?>
            <label>E-Mail:</label><br />
            <input type="text" name="email" value="<?php echo $email; ?>" />
            <br /><br />
            <label>Password:</label><br />
            <input type="password" name="password1" value="" />
            <br />
            <label>Retype Password:</label><br />
            <input type="password" name="password2" value="" />
            <br /><br />
            <input type="submit" value="Submit" />

        </form>
    </body>
</html>
