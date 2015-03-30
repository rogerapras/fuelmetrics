<?php session_start(); ?>
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
        echo '<h1>Oops! sorry ' . $_SESSION['email'] = $email . ', but there was a problem  with the' . $_SESSION['problem'] . '</h1>';
        ?>
    </body>
</html>
