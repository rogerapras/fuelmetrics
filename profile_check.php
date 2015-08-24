<?php

include './classes/Validation.class.php';
include './classes/Database.class.php';
include './classes/Messages.class.php';
include './classes/Util.class.php';

$validate = new Validation();
$database = new Database();
$messages = new Messages();
$util = new Util();

$first_name = filter_input(INPUT_POST, 'first_name');
$last_name = filter_input(INPUT_POST, 'last_name');
$gender = filter_input(INPUT_POST, 'gender');
$dob_day = filter_input(INPUT_POST, 'dob_day');
$dob_month = filter_input(INPUT_POST, 'dob_month');
$dob_year = filter_input(INPUT_POST, 'dob_year');
$location_state = filter_input(INPUT_POST, 'location_state');
$location_zip = filter_input(INPUT_POST, 'location_zip');
$location_city = filter_input(INPUT_POST, 'location_city');

if ($util->isPost()) {

    if ($validate->fieldIsEmpty($first_name)) {
        $messages->addError('First Name is a required field.');
    }
    if ($validate->fieldIsEmpty($last_name)) {
        $messages->addError('Last Name is a required field.');
    }

    if ($messages->hasErrors()) {
        $messages->displayErrorMsgs();
        include 'profileform.php';
        exit();
    }
}

if ($database->insertUserProfile($first_name, $last_name, $gender, $dob_day, $dob_month, $dob_year, $location_state, $location_zip, $location_city)) {
    echo "Profile Update Successful!";
} else {
    echo "Profile Update Failed.";
}
?>

