<?php

class Database {

    public function checkUserLogin($email, $pass) {

        // Encrypt the password before adding to database.
        $pass = sha1($pass);

        $db = new PDO("mysql:host=localhost;dbname=phpclasswinter2015; port=3306;", "root", "");
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

    public function insertUser($email, $pass) {

        // Encrypt the password before adding to database.
        $pass = sha1($pass);

        $db = new PDO("mysql:host=localhost;dbname=phpclasswinter2015; port=3306;", "root", "");
        $dbs = $db->prepare('insert into signup set email = :email, password =:password');

        // you must bind the data before you execute
        $dbs->bindParam(':email', $email, PDO::PARAM_STR);
        $dbs->bindParam(':password', $pass, PDO::PARAM_STR);

        // When you execute remember that a rowcount means a change was made
        if ($dbs->execute() && $dbs->rowCount() > 0) {
            return 'Data was added<br />';
        } else {
            return 'Data was NOT added<br />';
        }
    }
    
        public function insertReciept($dateOfPurchase, $pricePerGallon, $numberOfGallons, $gasStationName, $gasStationStreet, $gasStationZip, $gasStationCity, $gasStationState) {

        $db = new PDO("mysql:host=localhost;dbname=phpclasswinter2015; port=3306;", "root", "");
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
    
        public function sendVerificationEmail($email, $pass, $hashLink) {

        // Encrypt the password before adding to database.
        $pass = sha1($pass);
        $verified = false;

        $db = new PDO("mysql:host=localhost;dbname=phpclasswinter2015; port=3306;", "root", "");
        $dbs = $db->prepare('insert into signup set email = :email, password =:password, hashLink = :hashLink, verified = :verified, passwordhint = :passwordhint' );

        // you must bind the data before you execute
        $dbs->bindParam(':email', $email, PDO::PARAM_STR);
        $dbs->bindParam(':password', $pass, PDO::PARAM_STR);
        $dbs->bindParam(':hashLink', $hashLink, PDO::PARAM_STR);
        $dbs->bindParam(':verified', $verified, PDO::PARAM_STR);
        $dbs->bindParam(':passwordhint', $passwordhint, PDO::PARAM_STR);

        // When you execute remember that a rowcount means a change was made
        if ($dbs->execute() && $dbs->rowCount() > 0) {
            //send email.
            
	$name = 'FuelMetrics.org Sign-up';
        $FMemail = 'do.not.reply@fuelmetrics.org';
	$message = '';
	$thank = "Thank you ".$name." for reaching out. Your message has been sent.";
	$to = $email;
	$subject = 'FuelMetrics.org Email Verification - Do not reply';
	$msg = "This email was sent to you in order to verify the user's email address. \n\n".
		"Click on the following link to verify &quot;".$email."&quot; and complete the sign-up process. \n\n".
		"<a href='fuelmetrics.org/verify.php?verifycode=".$hashLink."'>Link</a>\n";       

        mail($to, $subject, $msg, 'From:'.$FMemail);
                  
            return true;
        } else {
            //something went wrong.
            return false;
        }
    }

}
