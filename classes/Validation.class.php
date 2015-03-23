<?php

class Validation {

    public function emailIsNotEmpty($email) {
        if (!empty($email)) {
            return true;
        } else {
            return false;
        }
    }
    
        public function fieldIsNotEmpty($fieldVar) {
        if (!empty($fieldVar)) {
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
    
        public function dateIsValid($date) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) != false) {
            return true;
        } else {
            return false;
        }
    }

    public function doesEmailExist($email) {
        $db = new PDO("mysql:host=localhost;dbname=phpclasswinter2015; port=3306;", "root", "");
        $dbs = $db->prepare('SELECT * FROM signup WHERE email = :email');

        $dbs->bindParam(':email', $email, PDO::PARAM_INT);

        if ($dbs->execute() && $dbs->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function fullNameIsValid($name) {
        if (!empty($name)) {
            return true;
        } else {
            return false;
        }
    }

    public function passwordIsNotEmpty($pass) {
        if (!empty($pass)) {
            return true;
        } else {
            return false;
        }
    }

    public function passwordIsValid($pass) {
        if ((strlen($pass) >= 5)) {
            return true;
        } else {
            return false;
        }
    }
    
    public function passwordsAretheSame($pass1, $pass2) {
        if (($pass1) === ($pass2)) {
            return true;
        } else {
            return false;
        }
    }
    
    public function passwordIsLongEnough($pass) {
        if ((strlen($pass) >= 8)) {
            return true;
        } else {
            return false;
        }
    }

}
