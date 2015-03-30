<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        include './classes/Database.class.php';
        $database = new Database();

        if (isset($_GET['activationkey'])) {
            $activationKey = $_GET['activationkey'];
            if ($database->updateActivationState($activationKey)) {
                $email = $database->confirmActivation($activationKey);
                 foreach ($email as $value) {
                echo "Thank you! User: [ $value ] is now activated.<br /><br /><p>"
                 . "Head over to the <a href='./login.php'>Login Page</a> to get your profile set up!<p>";}
            }
        }
        ?>
    </body>
</html>
