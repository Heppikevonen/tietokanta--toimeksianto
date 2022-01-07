<?php
session_start();

require_once "../include/headers.php";
require_once "../include/functions.php";

/**
 * Login with existing user
 */

try {
    $pdo = getConnection();

    if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {
        header("HTTP/1.1 401 Unauthorized");
        echo '{"error": "Authentication failed."}';
        exit;
    } else {
        $uname = filter_var($_SERVER['PHP_AUTH_USER'], FILTER_SANITIZE_EMAIL);
        $password = filter_var($_SERVER["PHP_AUTH_PW"], FILTER_SANITIZE_STRING);
    }
    
    $fetchuser = getQueryResult($pdo, "SELECT * FROM kayttajatiedot WHERE ktun = ?", PDO::FETCH_ASSOC, [$uname]);
    
    foreach ($fetchuser as $row) {
        $hashedPassword = $row['ksal'];
        $username = $row['ktun'];
        $id = $row['kid'];
    }

    if (!password_verify($password, $hashedPassword)) {
        header('HTTP/1.1 401 Unauthorized');
        echo json_encode(['message' => 'Väärä käyttäjätunnus tai salasana']);
        exit;
    } else {
        echo json_encode(['message' => 'Kirjauduit sisään']);
    }
    $_SESSION["id"] = $id;
    $_SESSION["uname"] = $uname;
    $_SESSION["pwd"] = $password;
} catch (Exception $e) {
    responseError($e);
}