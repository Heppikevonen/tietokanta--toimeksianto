<?php

/**
 * Echoes query response as JSON
 * @param PDO $connection Database connection
 * @param string $query SQL query
 * @param int $fetchMethod PDO fetch method
 * @param array $parameters possible query parameters
 */
function responseAsJson(PDO $connection, string $query, int $fetchMethod, array $parameters = [])
{
    $prepared = $connection->prepare($query);
    $prepared->execute($parameters);

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($prepared->fetchAll($fetchMethod));
}


/**
 * Echoes success or error string depending on query success
 * @param PDO $connection Database connection
 * @param string $query SQL query
 * @param string $success Response string
 * @param string $error Error string
 * @param array $parameters possible query parameters
 */
function responseString(PDO $connection, string $query, string $success, string $error, array $parameters = [])
{
    $prepared = $connection->prepare($query);

    if ($prepared->execute($parameters)) {
        $response = ["message" => $success];
    } else {
        $response = ["message" => $error];
    }

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($response);
}

/**
 * @param PDO $connection Database connection
 * @param string $query SQL query
 * @param int $fetchMethod PDO fetch method
 * @param array $parameters possible query parameters
 * @return bool|array
 */
function getQueryResult(PDO $connection, string $query, int $fetchMethod, array $parameters = []): bool|array
{
    $prepared = $connection->prepare($query);
    $prepared->execute($parameters);
    return $prepared->fetchAll($fetchMethod);
}

/**
 * @return PDO Database connection
 */
function getConnection(): PDO
{
    $connection = new PDO("mysql:host=localhost;dbname=k9rave00", "root", "");
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $connection;
}

/**
 * Checks if the user is logged in
 */

function isLoggedIn() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_SESSION['uname'])) {
        $logged = "true";
    } else {
        $logged = "false";
    }

    return $logged;
}