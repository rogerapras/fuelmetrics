<?php session_start(); ?>
<?php
$_SESSION['loggedin'] = false;

include './classes/Validation.class.php';
include './classes/Database.class.php';
include './classes/Messages.class.php';
include './classes/Util.class.php';

$validate = new Validation();
$database = new Database();
$messages = new Messages();
$util = new Util();

$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');


if ($util->isPost()) {

    if ($validate->fieldIsEmpty($email)) {
        $messages->addError('Email is a required field.');
    } else {

        if (!$validate->emailIsValid($email)) {
            $messages->addError('Email formatting is invalid.');
        }
    }

    if ($validate->fieldIsEmpty($password)) {
        $messages->addError('Password is a required field.');
    } 

    if ($messages->hasErrors()) {
        $messages->displayErrorMsgs();
        include './login.php';
        exit();
    }
}

if ($database->checkUserLogin($email, $password)) {
    $_SESSION['user_id'] = ($database->getUserID($email, $password));
    $_SESSION['loggedin'] = true;
    $_SESSION['email'] = $email;
    header('Location: profileform.php');
} else {
    $_SESSION['loggedin'] = false;
    echo "Login Failed.";
}

    $_SESSION['loggedin'] = true;
    $_SESSION['email'] = $email;
    header('Location: admin.php');

?>
