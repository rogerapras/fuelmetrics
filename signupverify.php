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

    if (!$validate->emailIsNotEmpty($email)) {
        $messages->addError('Email is a required field.');
    } else {

        if (!$validate->emailIsValid($email)) {
            $messages->addError('Email formatting is invalid.');
        } //else {
        // if (!$validate->doesEmailExist($email)) {
        //    $messages->addError('Email already exists in our database!');
        //}
        //}
    }

    if (!$validate->passwordIsNotEmpty($password1)) {
        $messages->addError('Password is a required field.');
    } else {

        if (!$validate->passwordIsLongEnough($password1)) {
            $messages->addError('Password must be eight characters or greater.');
        } else {

            if (!$validate->passwordsAreTheSame($password1, $password2)) {
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
$hashLink = sha1($email + $password1);
if (!$validate->sendVerificationEmail($email, $password1, $hashLink, $passwordhint)) {
    $_SESSION['email'] = $email;
    header('Location: emailVerify.php');
} else {
    header('Location: oops.php');
}


?>
