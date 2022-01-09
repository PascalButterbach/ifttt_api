<?php
include("../connection.php");
$db = new dbObj();
$connection = $db->getConnstring();

$request_method = $_SERVER["REQUEST_METHOD"];

switch ($request_method) {
    case 'GET':
        retrieve_latest_command();
        break;
    case 'POST':
        insert_command();
        break;
    default:
        // Invalid Request Method
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}


function insert_command()
{
    global $connection;

    $data = json_decode(file_get_contents('php://input'), true);
    $command = strtoupper($data["command"]);
    $value = strtoupper($data["value"]);

    echo $query = "INSERT INTO command (command, value) VALUES ('$command', $value)";

    if (mysqli_query($connection, $query)) {
        http_response_code(200);
        $response = array(
            'status' => 1,
            'status_message' => 'Command added successfully.'
        );
    } else {
        http_response_code(401);
        $response = array(
            'status' => 0,
            'status_message' => 'Command insertion failed.'
        );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}


function retrieve_latest_command()
{
    global $connection;
    $query = "SET @UPDATE_ID := 0;
    UPDATE command
    INNER JOIN (SELECT `id` from `command` WHERE retrieved = false 
    order by `createdAt` limit 1) as cmd using (`id`)
    SET `retrieved` = true, id = (SELECT @update_id := id);
    SELECT @UPDATE_ID;";

    $result = mysqli_multi_query($connection, $query);
    $updated_id = 0;
    do {
        if ($result = $connection->store_result()) {
            $updated_id = $result->fetch_all(MYSQLI_ASSOC)[0]["@UPDATE_ID"];
            $result->free();
        }
    } while ($connection->next_result());

    $query = "SELECT * FROM command";

    if ($updated_id != 0) {
        $query .= " WHERE id=" . $updated_id;
    } else {
        return;
    }

    $response = array();
    $result = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_array($result)) {

        $response = array_filter(
            $row,
            fn($key) => in_array($key, ['command', 'value']),
            ARRAY_FILTER_USE_KEY
        );
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}