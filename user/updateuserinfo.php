<?php
session_start();
require "../include/headers.php";
require "../include/functions.php";

/**
 * Update user info: firstname, lastname, email, address, city and postal code by ID. Takes data from JSON body.
 * Example: /user/updateuserinfo.php?id=1
 */

if (isLoggedIn() == "false") {
    header("HTTP/1.1 403 Forbidden");
    echo json_encode(["error" => "Not logged in."]);
    exit;
}

try {
    $db = getConnection();
    $input = json_decode(file_get_contents('php://input'));
    
    $age = filter_var($input->age, FILTER_SANITIZE_NUMBER_INT);
    $sex = filter_var($input->sex, FILTER_SANITIZE_STRING);
    $height = filter_var($input->height, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $size = filter_var($input->size, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $params = [$_SESSION['id'], $age, $sex, $height, $size];
    $sql = "INSERT INTO yksityistiedot VALUES (?, ?, ?, ?, ?)";

    responseString($db, $sql, "Tiedot lisätty", "Virhe. Tietoja ei lisätty", $params);

    
} catch (Exception $e) {
    responseError($e);
}