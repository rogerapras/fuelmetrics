<?php
if (empty($_POST)) {
    session_start();
}
?>
<?php
//// ERROR WORKS NEED TO COMPLETE DOB AND OTHER ERRORS TROUBLE WITH DROP DOWNS
////include_ './profile_check.php';// put your code here
//
//
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Profile Page</title>
    </head>
    <body>
        <?php
        include_once './header.php';

        if (!empty($_POST)) {
            $first_name = filter_input(INPUT_POST, 'first_name');
            $last_name = filter_input(INPUT_POST, 'last_name');
            $gender = filter_input(INPUT_POST, 'gender');
            $dob_day = filter_input(INPUT_POST, 'dob_day');
            $dob_month = filter_input(INPUT_POST, 'dob_month');
            $dob_year = filter_input(INPUT_POST, 'dob_year');
            $location_state = filter_input(INPUT_POST, 'location_state');
            $location_zip = filter_input(INPUT_POST, 'location_zip');
            $location_city = filter_input(INPUT_POST, 'location_city');
        } else {
            $first_name = "";
            $last_name = "";
            $gender = "";
            $dob_day = "";
            $dob_month = "";
            $dob_year = "";
            $location_state = "";
            $location_zip = "";
            $location_city = "";
        }
        ?>
        <h1>FuelMetrics.org Profile-Page</h1>
        <form action="profile_check.php" method="post">
            <h2>Profile Information</h2>
            * = Required<br /><br />
            * First:<input type="text" name="first_name" placeholder="First Name" value="<?php echo $first_name; ?>"><br />
            * Last: <input type="text" name="last_name" placeholder="Last Name" value="<?php echo $last_name; ?>"><br />
            <br /><br />
            <h2>Additional Information</h2>
            (not required)<br /><br />
            <label>Gender:</label><br />
            <input type="text" name="gender" placeholder="Gender" value="<?php echo $gender; ?>"><br />
            <br /><br />
            <label>Date of Birth:</label><br />
            Day:<input type="text" name="dob_day" placeholder="dd" value="<?php echo $dob_day; ?>"><br />
            Month:<input type="text" name="dob_month" placeholder="mm" value="<?php echo $dob_month; ?>"><br />
            Year:<input type="text" name="dob_year" placeholder="yyyy" value="<?php echo $dob_year; ?>"><br />
            <br /><br />
            <label>Home Location:</label><br />
            State:<input type="text" name="location_state" placeholder="State" value="<?php echo $location_state; ?>"><br />
            Zip Code:<input type="text" name="location_zip" placeholder="Zip Code" value="<?php echo $location_zip; ?>"><br />
            City:<input type="text" name="location_city" placeholder="City" value="<?php echo $location_city; ?>"><br />
            <br /><br />
            <input type="submit" value="Submit" />
        </form>
    </body>
</html>
