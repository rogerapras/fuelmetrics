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

    public function emailIsValid($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) != false) {
            return true;
        } else {
            return false;
        }
    }

    public function doesEmailExist($email) {

        include './classes/dbconnect.php';

        $dbs = $db->prepare('SELECT * FROM user_access WHERE email = :email');

        $dbs->bindParam(':email', $email, PDO::PARAM_INT);

        if ($dbs->execute() && $dbs->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    public function feildsAretheSame($field1, $field2) {
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
