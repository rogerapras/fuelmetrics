<?php

class Database {

    public function displayReciepts($userID) {

        include './classes/dbconnect.php';

        $dbs = $db->prepare('SELECT * FROM reciepts WHERE userID = ' . $userID, ' ORDER BY date_entered SORT DESC');
        if ($dbs->execute() && $dbs->rowCount() > 0) {
            $reciepts = $dbs->fetchAll(PDO::FETCH_ASSOC);
            echo '<table>';
            echo '<tr>';
            echo '<th>' . 'Reciept ID:' . '</th>';
            echo '<th>' . 'Date of Purchase:' . '</th>';
            echo '<th>' . 'Price per Gallon:' . '</th>';
            echo '<th>' . 'Number of Gallons:' . '</th>';
            echo '<th>' . 'Gas Station Name:' . '</th>';
            echo '<th>' . 'Comments/Notes:' . '</th>';
            echo '</tr>';
            foreach ($reciepts as $value) {
                echo '<tr>';
                echo '<td>' . $value["recieptID"] . '</td>';
                echo '<td>' . $value["dateOfPurchase"] . '</td>';
                echo '<td>' . $value["pricePerGallon"] . '</td>';
                echo '<td>' . $value["numberOfGallons"] . '</td>';
                echo '<td>' . $value["gasStationName"] . '</td>';
                echo '<td>' . $value["comments"] . '</td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo 'No results found';
        }
    }

    public function checkUserLogin($email, $pass) {

        $pass = sha1($pass);

        include './classes/dbconnect.php';

        $dbs = $db->prepare('SELECT * FROM user_profiles WHERE email = :email and password = :password');

        // you must bind the data before you execute
        $dbs->bindParam(':email', $email, PDO::PARAM_STR);
        $dbs->bindParam(':password', $pass, PDO::PARAM_STR);

        // When you execute remember that a rowcount means a change was made
        if ($dbs->execute() && $dbs->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function confirmActivation($activation_key) {

        include './classes/dbconnect.php';

        $results = array();

        $dbs = $db->prepare("SELECT email, activation_state FROM user_profiles WHERE activation_key = '$activation_key' limit 1");

        if ($dbs->execute() && $dbs->rowCount() > 0) {
            $results = $dbs->fetch(PDO::FETCH_ASSOC);
            return $results;
        }
    }

    public function updateActivationState($activationKey) {

        include './classes/dbconnect.php';

        $dbs = $db->prepare("UPDATE user_profiles set activation_state = '1' WHERE activation_key = '$activationKey'");

        // When you execute remember that a rowcount means a change was made
        if ($dbs->execute() && $dbs->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getHint($email) {

        include './classes/dbconnect.php';

        $dbs = $db->prepare('SELECT hint FROM user_profiles WHERE email = :email');

        $dbs->bindParam(':email', $email, PDO::PARAM_INT);

        if ($dbs->execute() && $dbs->rowCount() > 0) {
            return $hint;
        } else {
            return false;
        }
    }

    public function hintEmail($email) {

        $to = $_SESSION['email'];
        $subject = "FuelMetrics.org password hint...";

        $message = "
<html>
    <head>
        <title>FuelMetrics.org - Forgot your password?</title>
    </head>
    <body>
        <br />
        <a href='http://fuelmetrics.org/' ><img alt='logo' src='http://test.fuelmetrics.org/images/emaillogo.png' /></a><br /><br /><br />
        <hr /><br /><br />
        Greetings,<br /><br />
        A request for a password hint for the account associated with this email address.<br /><br />
        Your password hint is:<p>$hint</p>
        If you did not initiate the request, then simply disregard this email.
        If this password hint still doesn't help you remember your password, then you can reset it using the link below.<br /><br />
        Click the URL below or copy and paste it into your browser to reset your
        password and resume using FuelMetrics.org.<br /><br /><br />
        <a href='http://test.fuelmetrics.org/pwreset.php?resetaccount=$to' >http://test.fuelmetrics.org/pwreset.php?resetaccount=$to</a><br /><br /><br />
        <hr /><br /><br />
        Thanks, and have a great day!<br /><br />
        &nbsp;&nbsp;&nbsp;-The FuelMetrics.org team<br /><br />
    </body>
</html>
";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <noreply@fuelmetrics.org>' . "\r\n";
        //$headers .= 'Cc: email@example.com' . "\r\n";

        if (mail($to, $subject, $message, $headers)) {
            return true;
        } else {
            return false;
        }
    }
    
    public function newSignupEmail() {

        $to = $_SESSION['email'];
        $link = (sha1($to));
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
        verify your account so you can begin tracking your auto fuel consumption
        and expenditures with our free and easy to use set of tools and charts.<br /><br />
        Click the URL below or copy and paste it into your browser to confirm your
        E-mail address and start using FuelMetrics.org.<br /><br /><br />
        <a href='http://test.fuelmetrics.org/verify.php?activationkey=$link' >http://fuelmetrics.org/verify.php?activationkey=$link</a><br /><br /><br />
        <hr /><br /><br />
        [ $to ] will now be your official FuelMetrics sign-in ID, which you
        will use to log in to your account.<br /><br />
        Thanks!<br /><br />
        &nbsp;&nbsp;&nbsp;-The FuelMetrics.org team<br /><br />
    </body>
</html>
";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <noreply@fuelmetrics.org>' . "\r\n";
        //$headers .= 'Cc: email@example.com' . "\r\n";

        if (mail($to, $subject, $message, $headers)) {
            return true;
        } else {
            return false;
        }
    }
    
    public function insertUserProfile($email, $pass, $password_hint) {

        $activation_key = sha1($email);

        include './classes/dbconnect.php';
        
        $dbs = $db->prepare('insert into user_profiles set '
                . 'email = :email, '
                . 'password = :password, '
                . 'password_hint = :password_hint, '
                . 'activation_key = :activation_key');
        
// binding the data before the execute
        $dbs->bindParam(':email', $email, PDO::PARAM_STR);
        $dbs->bindParam(':password', $pass, PDO::PARAM_STR);
        $dbs->bindParam(':password_hint', $password_hint, PDO::PARAM_STR);
        $dbs->bindParam(':activation_key', $activation_key, PDO::PARAM_STR);
        
// A successful execute: a rowcount means that a change was made
        if ($dbs->execute() && $dbs->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    
        public function updateUserProfile($email, $first_name, $last_name, $gender, $dob, $location_zip, $location_city, $location_state) {
            
        include './classes/dbconnect.php';

        $dbs = $db->prepare("UPDATE user_profiles set "
                . "first_name = :first_name, "
                . "last_name = :last_name, "
                . "gender = :gender, "
                . "dob = :dob, "
                . "location_zip = :location_zip, "
                . "location_city = :location_city, "
                . "location_state = :location_state "                    
                . "WHERE email = :email");
        
        $dbs->bindParam(':email', $email, PDO::PARAM_STR);
        $dbs->bindParam(':first_name', $first_name, PDO::PARAM_STR);
        $dbs->bindParam(':last_name', $last_name, PDO::PARAM_STR);
        $dbs->bindParam(':gender', $gender, PDO::PARAM_STR);
        $dbs->bindParam(':dob', $dob, PDO::PARAM_STR);
        $dbs->bindParam(':location_zip', $location_zip, PDO::PARAM_STR);
        $dbs->bindParam(':location_city', $location_city, PDO::PARAM_STR);
        $dbs->bindParam(':location_state', $location_state, PDO::PARAM_STR);

        // When you execute remember that a rowcount means a change was made
        if ($dbs->execute() && $dbs->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}