<?php
    $dbServerHost = "127.0.0.1";
    $dbUsername = "application";
    $dbPassword = "GB<YN~2zd+Cq!vAn";
    $dbName = "Reciplease";
    $dbPort = "3306";
    $db = new mysqli($dbServerHost, $dbUsername, $dbPassword, $dbName, $dbPort);

    function isLoggedIn() {
        if (isset($_SESSION["username"])) {
            return true;
        } else {
            return false;
        }
    }

    function register(&$fName, &$lName, &$email, &$favFood, &$username, &$password, $profilePhoto, &$dob, $dietaryRestrictions) {
        $fNameDB = ucfirst(strtolower($fName));
        $lNameDB = ucfirst(strtolower($lName));
        $emailDB = strtolower($email);
        $usernameDB = strtolower($username);
        $passwordDB = password_hash($password, PASSWORD_DEFAULT);
        # $profilePhoto = addslashes(file_get_contents($_FILES['profilePicture']['temp_name']));
        # $profilePhotoName = addslashes($_FILES['image']['name']);
        # $dietaryRestrictionsDB = implode(", ", $dietaryRestrictions);
        
        $sql = "INSERT INTO User (UserID, FirstName, LastName, UserName, Password, Email, ProfilePicture, DOB, FavoriteFood, DietaryRestrictions, DateRegistered) VALUES(
                null,
                '$fNameDB',
                '$lNameDB',
                '$usernameDB',
                '$passwordDB',
                '$emailDB',
                '{$profilePhoto}',
                STR_TO_DATE('$dob', '%Y-%m-%d'),
                '$favFood$dietaryRestrictions
                '$dietaryRestrictions',
                null
            )";
        $result = mysqli_query($GLOBALS['db'], $sql);

            if (!$result) {
                echo "Error Description: " . mysqli_error($sql);
            } else {
                header("Location:../login");
            }
    }
?>