<!DOCTYPE html>
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
        if (!empty($_POST)) {
            $email = filter_input(INPUT_POST, 'email');
        } else {
            $email = "";
            $emailErrorMessage = "";
            $passwordErrorMessage = "";
        }
        ?>
        <h1>FuelMetrics.org Account log-in</h1>
        <form action="logincheck.php" method="post">
            <?php if (!empty($emailErrorMessage)) {
                echo $emailErrorMessage;
            }
            ?>
            <label>E-Mail:</label><br />
            <input type="text" name="email" value="<?php echo $email; ?>" />
            <?php if (!empty($emailErrorMessage)) {
                echo '<div class="formError"> * ' . $emailErrorMessage . '</div>';
            }
            ?>
            <br />
            <label>Password:</label><br />
            <input type="password" name="password" value="" />
            <?php if (!empty($passwordErrorMessage)) {
                echo '<div class="formError"> * ' . $passwordErrorMessage . '</div>';
            }
            ?>
            <br /><br />
            <input type="submit" value="Submit" />

        </form>
    </body>
</html>
