<?php

class Validation {

    public function fieldIsEmpty($fieldVar) {
        if (empty($fieldVar)) {
            return true;
        } else {
            return false;
        }
    }

    public function fieldIsNumeric($fieldVar) {
        if (is_numeric($fieldVar)) {
            return true;
        } else {
            return false;
        }
    }

// allregex function checks $rx with fieldVar to ensure &pattern matches the field   

    public function allregex_Check($rx, $fieldVar) {
        if ($rx === 'first_name') {
            $pattern = '/^[a-zA-Z$]/';
        } if ($rx === 'last_name') {
            $pattern = '/^[a-zA-Z$]/';
        } if ($rx === 'fuel_price') {
            $pattern = '/^\$?\d+(\.\d{2})?$/';
        } if ($rx === 'gal_purchased') {
            $pattern = '/^\$?\d+(\.\d{2})?$/';
        } if ($rx === 'fuel_total') {
            $pattern = '/^\$?\d+(\.\d{2})?$/';
        } if ($rx === 'location_add') {
            $pattern = '/^[0-9a-zA-Z. ]+$/';
        } if ($rx === 'location_zip') {
            $pattern = '/^[0-9]{5}(?:-[0-9]{4})?$/';
        } if (preg_match($pattern, $fieldVar)) {
            return true;
        } else {
            return false;
        }
    }
    
    
    // Station Regex function checks $rx with fieldVar to ensure &pattern matches the field

    public function stationregex_Check($rx, $fieldVar) {
        if ($rx === 'station_brand') { $pattern = '/^[a-zA-Z$]/'; }
        if ($rx === 'station_name') { $pattern = '/^[0-9a-zA-Z$]/'; }
        if ($rx === 'station_street') { $pattern = '/^[0-9a-zA-Z. ]+$/'; }
        if ($rx === 'station_zip') { $pattern = '/^[0-9]{5}(?:-[0-9]{4})?$/'; }
        if ($rx === 'station_regular_price') { $pattern = '/^\$?\d+(\.\d{2})?$/'; }
        if ($rx === 'station_midgrade_price') { $pattern = '/^\$?\d+(\.\d{2})?$/'; }
        if ($rx === 'station_premium_price') { $pattern = '/^\$?\d+(\.\d{2})?$/'; }
        if ($rx === 'station_diesel_price') { $pattern = '/^\$?\d+(\.\d{2})?$/'; }
        if (preg_match($pattern, $fieldVar)) { return true; } 
        else { return false; }
    }

    public function emailIsValid($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) != false) {
            return true;
        } else {
            return false;
        }
    }

    public function doesEmailExist($email) {
        include './classes/dbconnect.php';
        $dbs = $db->prepare('SELECT * FROM user_profiles WHERE email = :email');
        $dbs->bindParam(':email', $email, PDO::PARAM_INT);
        if ($dbs->execute() && $dbs->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function fieldsAreTheSame($field1, $field2) {
        if (($field1) === ($field2)) {
            return true;
        } else {
            return false;
        }
    }

    public function checkFieldLength($feildVar, $num) {
        if ((strlen($feildVar) >= $num)) {
            return true;
        } else {
            return false;
        }
    }

}
