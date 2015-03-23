<!DOCTYPE html>
<?php
if (!isset($_SESSION['loggedin'])) {
    session_start();
}
?>
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
        } else {
            $dateOfPurchase = date("m/d/Y");
            $selectedYear = date("Y");
            $selectedMonth = date("m");
            $selectedDay = date("d");
            $pricePerGallon = '';
            $numberOfGallons = '';
            $gasStationName = '';
            $gasStationStreet = '';
            $gasStationZip = '';
            $gasStationCity = '';
            $gasStationState = '';
        }
        ?>
        <h1>FuelMetrics.org Fuel Reciept form</h1>
        <form action="insertfuelreciept.php" method="post">

            <label>Date of purchase:</label><br />

            <?php
            include './include-years.php';
            echo '<select name="selectedYear">';
            foreach ($years as $key => $value) {
                if ($selectedYear == $key) {
                    echo '<option value="', $key, '" selected="selected">', $value, '</option>';
                } else {
                    echo '<option value="', $key, '">', $value, '</option>';
                }
            }
            echo '</select>';
            ?>

            <?php
            include './include-months.php';
            echo '<select name="selectedMonth">';
            foreach ($months as $key => $value) {
                if ($selectedMonth == $key) {
                    echo '<option value="', $key, '" selected="selected">', $value, '</option>';
                } else {
                    echo '<option value="', $key, '">', $value, '</option>';
                }
            }
            echo '</select>';
            ?>
            <?php
            include './include-days.php';
            echo '<select name="selectedDay">';
            foreach ($days as $key => $value) {
                if ($selectedDay == $key) {
                    echo '<option value="', $key, '" selected="selected">', $value, '</option>';
                } else {
                    echo '<option value="', $key, '">', $value, '</option>';
                }
            }
            echo '</select>';
            ?>

            <br /><br />
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
            <br /><br />
            <label>Gas Station Street Address:</label><br />
            <input type="text" name="gasStationStreet" value="<?php echo $gasStationStreet; ?>" />
            <br /><br />
            <label>Gas Station Zip Code:</label><br />
            <input type="text" name="gasStationZip" value="<?php echo $gasStationZip; ?>" />
            <br /><br />
            <label>Gas Station City:</label><br />
            <input type="text" name="gasStationCity" value="<?php echo $gasStationCity; ?>" />
            <br /><br />
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
            <br /><br />
            <input type="submit" value="Submit" />

        </form>
    </body>
</html>
