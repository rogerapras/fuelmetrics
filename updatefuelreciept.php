<?php session_start(); ?>
<?php

include './classes/Validation.class.php';
include './classes/Database.class.php';
include './classes/Messages.class.php';
include './classes/Util.class.php';

$validate = new Validation();
$database = new Database();
$messages = new Messages();
$util = new Util();

$dateOfPurchase = filter_input(INPUT_POST, 'dateOfPurchase');
$selectedYear = filter_input(INPUT_POST, 'selectedYear');
$selectedMonth = filter_input(INPUT_POST, 'selectedMonth');
$selectedDay = filter_input(INPUT_POST, 'selectedDay');
$pricePerGallon = filter_input(INPUT_POST, 'pricePerGallon');
$numberOfGallons = filter_input(INPUT_POST, 'numberOfGallons');
$gasStationName = filter_input(INPUT_POST, 'gasStationName');
$gasStationStreet = filter_input(INPUT_POST, 'gasStationStreet');
$gasStationZip = filter_input(INPUT_POST, 'gasStationZip');
$gasStationCity = filter_input(INPUT_POST, 'gasStationCity');
$gasStationState = filter_input(INPUT_POST, 'gasStationState');



if ($util->isPost()) {

    if (!$validate->fieldIsNotEmpty($dateOfPurchase)) {
        $messages->addError('Date of purchase field is a required field.');
    }

    if (!$validate->fieldIsNotEmpty($pricePerGallon)) {
        $messages->addError('Price per Gallon field is a required field.');
    }

    if (!$validate->fieldIsNotEmpty($numberOfGallons)) {
        $messages->addError('Number of Gallons field is a required field.');
    }

    if (!$validate->fieldIsNotEmpty($gasStationZip)) {
        $messages->addError('Gas Station Zip Code field is a required field.');
    }

    if ($messages->hasErrors()) {
        $messages->displayErrorMsgs();
        include './fuelreceiptform.php';
        exit();
    }
}

if ($database->insertReciept($dateOfPurchase, $pricePerGallon, $numberOfGallons, $gasStationName, $gasStationStreet, $gasStationZip, $gasStationCity, $gasStationState)) {
    echo '<h1>Success!!!</h1>';
} else {
    echo '<h1>Success!!!</h1>';
}
/*
  if ($database->checkUserLogin($email, $password)) {
  $_SESSION['loggedin'] = true;
  $_SESSION['email'] = $email;
  header('Location: admin.php');
  } else {
  $_SESSION['loggedin'] = false;
  echo "Login Failed.";
  }
 */
?>
