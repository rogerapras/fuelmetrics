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
$password1 = filter_input(INPUT_POST, 'password1');
$password2 = filter_input(INPUT_POST, 'password2');
$passwordhint = filter_input(INPUT_POST, 'passwordhint');


if ($util->isPost()) {

    if ($validate->fieldIsEmpty($email)) {
        $messages->addError('Email is a required field.');
    } else {

        if (!$validate->emailIsValid($email)) {
            $messages->addError('Email formatting is invalid.');
        } else {
            if ($validate->doesEmailExist($email)) {
                $messages->addError('Email already exists in our database!');
            }
        }
    }

    if ($validate->fieldIsEmpty($password1)) {
        $messages->addError('Password is a required field.');
    } else {

        if (!$validate->checkFieldLength($password1, 8)) {
            $messages->addError('Password must be eight characters or greater.');
        } else {

            if (!$validate->feildsAreTheSame($password1, $password2)) {
                $messages->addError('Passwords must match.');
            }
        }
    }
    if ($messages->hasErrors()) {
        $messages->displayErrorMsgs();
        include './signup.php';
        exit();
    }
}

if ($database->insertNewUser($email, $password1, $passwordhint)) {
    $_SESSION['email'] = $email;
    $_SESSION['pass'] = (sha1($password1));
    $_SESSION['link'] = (sha1($email));
} else {
    $_SESSION['email'] = $email;
    $_SESSION['problem'] = ' database INSERT.';
    header('Location: oops.php');
}

if ($database->newSignupEmail()) {
    header('Location: emailverify.php');
} else {
    $_SESSION['email'] = $email;
    $_SESSION['problem'] = ' verification email.';
    header('Location: oops.php');
}
?>
