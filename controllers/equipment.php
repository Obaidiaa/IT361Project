<?php

// Path: equipment.php

$heading = "Equipment Management";

// load the config file
$config = require 'Core/config.php';

// create a new database object
$db = new Database($config['database']);

// get the request method
$method = $_SERVER['REQUEST_METHOD'];

// check if the request method is POST
if ($method === 'POST') {


    // dd($_POST);

    $_POST['_method'] = $_POST['_method'] ?? NULL;
    // delete equipment details if method is DELETE
    if ($_POST['_method'] === 'DELETE') {
        $db->query('DELETE FROM Equipment WHERE EquipmentID = :EquipmentID', ['EquipmentID' => $_POST['id']]);
        $response = [
            'status' => 'success',
            'message' => 'Equipment deleted successfully.'
        ];
        header('Content-Type: application/json');
        http_response_code(200);
        echo json_encode($response);
        exit;
    }

    // check if all fields are filled
    if (!isset($_POST['equipmentname']) || !isset($_POST['quantity'])) {
        $response = [
            'status' => 'error',
            'message' => 'All fields are required.'
        ];
        header('Content-Type: application/json');
        http_response_code(400);
        echo json_encode($response);
        exit;
    }

    // update equipment details if method is PUT else insert new equipment details
    if ($_POST['_method'] === 'PUT') {
        $data = [
            'EquipmentID' => $_POST['equipmentid'],
            'EquipmentName' => $_POST['equipmentname'],
            'Quantity' => $_POST['quantity'],
        ];

        $db->query('UPDATE Equipment SET EquipmentName = :EquipmentName, Quantity = :Quantity WHERE EquipmentID = :EquipmentID', $data);
        $response = [
            'status' => 'success',
            'message' => 'Equipment updated successfully.'
        ];
        header('Content-Type: application/json');
        http_response_code(200);
        echo json_encode($response);
        exit;
    }

    $data = [
        'EquipmentName' => $_POST['equipmentname'],
        'Quantity' => $_POST['quantity'],
    ];

    $db->query('INSERT INTO Equipment (EquipmentName, Quantity) VALUES (:EquipmentName, :Quantity)', $data);
    $response = [
        'status' => 'success',
        'message' => 'Equipment added successfully.'
    ];
    header('Content-Type: application/json');
    http_response_code(200);
    echo json_encode($response);
    exit;
} else {


    $url = parse_url(($_SERVER['REQUEST_URI']))['path'];


    if ($url === '/getequipment') {
        // get all equipment details from database and store in $equipments variable to be used in the view file equimpent.view.php
        $equipments = $db->query('SELECT DISTINCT
        EquipmentID,
        EquipmentName,
        Quantity,
        (SELECT COUNT(*) FROM equipment) AS countEquipment FROM equipment;')->fetchAll(PDO::FETCH_ASSOC);
        $response = [
            'status' => 'success',
            'message' => 'Equipment retrieved successfully.',
            'data' => $equipments
        ];
        header('Content-Type: application/json');
        http_response_code(200);
        echo json_encode($response);
        exit;
    } else {

        // load the view file equimpent.view.php
        require "views/equimpent.view.php";
    }
}
