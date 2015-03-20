<?php

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    echo '<a href="?logout=1">Logout</a>';
}
if (isset($_SESSION['loginPage']) && $_SESSION['loginPage'] === true) {
    echo 'Not Registered? <a href="signup.php">Sign Up</a> here!<br />';
}

if (isset($_SESSION['signupPage']) && $_SESSION['signupPage'] === true) {
    echo 'Already registered? <a href="login.php">Log in</a> here.';
}

$logout = filter_input(INPUT_GET, 'logout');

if ($logout == 1) {
    $_SESSION['loggedin'] = false;
}
?>