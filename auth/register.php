<?php

require "../include/headers.php";
require "../include/functions.php";

/**
 * Register a new user
 */
try {
    $db = getConnection();
    $body = json_decode(file_get_contents('php://input'));

    if (!$body) {
        throw new Exception("Pyynnön runko ei voi olla tyhjä!");
    }

    $username = filter_var($body->username, FILTER_SANITIZE_STRING);
    $password = password_hash(filter_var($body->password, FILTER_SANITIZE_STRING), PASSWORD_DEFAULT);

    $params = [null, $username, $password];
    $sql = "INSERT INTO kayttajatiedot VALUES (?, ?, ?)";

    responseString($db, $sql, "Käyttäjä rekisteröity", "Virhe. Käyttäjää ei rekisteröity", $params);
} catch (Exception $e) {
    responseError($e);
}
