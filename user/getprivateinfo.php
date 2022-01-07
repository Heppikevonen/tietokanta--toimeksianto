<?php
session_start();
require "../include/headers.php";
require "../include/functions.php";

if (isLoggedIn() == "false") {
    header("HTTP/1.1 403 Forbidden");
    echo json_encode(["error" => "Not logged in."]);
    exit;
}

try {
    $db = getConnection();
    $id = filter_var($_SESSION['id'], FILTER_SANITIZE_NUMBER_INT);


    responseAsJson($db, "SELECT * FROM yksityistiedot WHERE kid=?", PDO::FETCH_ASSOC, [$id]);
} catch (Exception $e) {
    responseError($e);
}