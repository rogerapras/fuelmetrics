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

    public function doesEmailExist($email) {

        include './classes/dbconnect.php';

        $dbs = $db->prepare('SELECT * FROM user_access WHERE email = :email');

        $dbs->bindParam(':email', $email, PDO::PARAM_INT);

        if ($dbs->execute() && $dbs->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function checkUserLogin($email, $pass) {

        $pass = sha1($pass);

        include './classes/dbconnect.php';

        $dbs = $db->prepare('SELECT * FROM signup WHERE email = :email and password = :password');

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

    public function confirmActivation($activationKey) {

        include './classes/dbconnect.php';

        $results = array();

        $dbs = $db->prepare("SELECT email FROM user_access WHERE activationkey = '$activationKey' limit 1");

        if ($dbs->execute() && $dbs->rowCount() > 0) {
            $results = $dbs->fetch(PDO::FETCH_ASSOC);
            return $results;
        }
    }

    public function updateActivationState($activationKey) {

        include './classes/dbconnect.php';

        $dbs = $db->prepare("UPDATE user_access set activationstate = '1' WHERE activationkey = '$activationKey'");

        // When you execute remember that a rowcount means a change was made
        if ($dbs->execute() && $dbs->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function insertNewUser($email, $pass, $passwordhint) {

// Encrypt the password before adding to database.
        $pass = sha1($pass);
        $activationkey = sha1($email);
        $activationstate = 0;

        include './classes/dbconnect.php';

        $dbs = $db->prepare('insert into user_access set '
                . 'email = :email, '
                . 'password = :password, '
                . 'activationkey = :activationkey, '
                . 'activationstate = :activationstate, '
                . 'passwordhint = :passwordhint');

// binding the data before the execute

        $dbs->bindParam(':email', $email, PDO::PARAM_STR);
        $dbs->bindParam(':password', $pass, PDO::PARAM_STR);
        $dbs->bindParam(':activationkey', $activationkey, PDO::PARAM_STR);
        $dbs->bindParam(':activationstate', $activationstate, PDO::PARAM_STR);
        $dbs->bindParam(':passwordhint', $passwordhint, PDO::PARAM_STR);

// A successful execute: a rowcount means that a change was made

        if ($dbs->execute() && $dbs->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function newSignupEmail() {

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

    public function insertReciept($dateOfPurchase, $pricePerGallon, $numberOfGallons, $gasStationName, $gasStationStreet, $gasStationZip, $gasStationCity, $gasStationState) {

        include './classes/dbconnect.php';

        $dbs = $db->prepare('insert into reciepts set dateOfPurchase = :dateOfPurchase, pricePerGallon = :pricePerGallon, numberOfGallons = :numberOfGallons, gasStationName = :gasStationName, gasStationStreet = :gasStationStreet, gasStationZip = :gasStationZip, gasStationCity = :gasStationCity, gasStationState = :gasStationState');

        // you must bind the data before you execute
        $dbs->bindParam(':dateOfPurchase', $dateOfPurchase, PDO::PARAM_STR);
        $dbs->bindParam(':pricePerGallon', $pricePerGallon, PDO::PARAM_STR);
        $dbs->bindParam(':numberOfGallons', $numberOfGallons, PDO::PARAM_STR);
        $dbs->bindParam(':gasStationName', $gasStationName, PDO::PARAM_STR);
        $dbs->bindParam(':gasStationStreet', $gasStationStreet, PDO::PARAM_STR);
        $dbs->bindParam(':gasStationZip', $gasStationZip, PDO::PARAM_STR);
        $dbs->bindParam(':gasStationCity', $gasStationCity, PDO::PARAM_STR);
        $dbs->bindParam(':gasStationState', $gasStationState, PDO::PARAM_STR);

        // When you execute remember that a rowcount means a change was made
        if ($dbs->execute() && $dbs->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

}
