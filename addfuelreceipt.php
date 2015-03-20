<!DOCTYPE html>
<?php if (!isset($_SESSION['loggedin'])) {
    session_start();
} ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $_SESSION['signupPage'] = false;
        $_SESSION['loginPage'] = false;
        include_once './header.php';

        if (!empty($_POST)) {

            $dateOfPurchase = filter_input(INPUT_POST, 'dateOfPurchase');
            $pricePerGallon = filter_input(INPUT_POST, 'pricePerGallon');
            $numberOfGallons = filter_input(INPUT_POST, 'numberOfGallons');
            $gasStationName = filter_input(INPUT_POST, 'gasStationName');
            $gasStationCity = filter_input(INPUT_POST, 'gasStationCity');
            $gasStationState = filter_input(INPUT_POST, 'gasStationState');
        } else {
            $dateOfPurchase = '';
            $pricePerGallon = '';
            $numberOfGallons = '';
            $gasStationName = '';
            $gasStationCity = '';
            $gasStationState = '';
        }
        ?>
        <h1>FuelMetrics.org Account Sign-up</h1>
        <form action="insertfuelreceipt.php" method="post">

            <label>Date of purchase:</label><br />
            <input type="text" name="dateOfPurchase" value="<?php echo $dateOfPurchase; ?>" />
            <br /><br />
            <label>Price per gallon:</label><br />
            <input type="text" name="pricePerGallon" value="<?php echo $pricePerGallon; ?>" />
            <br /><br />
            <label>total # of gallons:</label><br />
            <input type="text" name="numberOfGallons" value="<?php echo $numberOfGallons; ?>" />
            <br /><br />
            <label>Gas Station Name:</label><br />
            <input type="text" name="gasStationName" value="<?php echo $gasStationName; ?>" />
            <br />
            <label>Gas Station Street Address:</label><br />
            <input type="text" name="gasStationStreet" value="<?php echo $gasStationStreet; ?>" />
            <br />
            <label>Gas Station City:</label><br />
            <input type="text" name="gasStationCity" value="<?php echo $gasStationCity; ?>" />
            <br />
            <label>Gas Station State:</label><br />
            <?php
            $selectedState = filter_input(INPUT_POST, 'gasStationStates');
            include './include-states.php';
            echo '<select name="gasStationStates">';
            foreach ($states as $key => $value) {
                if ($selectedState == $key) {
                    echo '<option value="', $key, '" selected="selected">', $value, '</option>';
                } else {
                    echo '<option value="', $key, '">', $value, '</option>';
                }
            }

            echo '</select>';
            ?>
            <br />
            <input type="submit" value="Submit" />

        </form>
    </body>
</html>
