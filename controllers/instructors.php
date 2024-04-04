<?php

// Path: instructor.php

// set the heading for the trainers management page
$heading = "Trainers Management";


// load the config file
$config = require 'Core/config.php';

// create a new database object
$db = new Database($config['database']);

// get the request method
$method = $_SERVER['REQUEST_METHOD'];

// check if the request method is POST
if ($method === 'POST') {

    // delete trainer details if method is DELETE
    if ($_POST['_method'] === 'DELETE') {
        $db->query('DELETE FROM Trainer WHERE TrainerID = :TrainerID', ['TrainerID' => $_POST['id']]);
        $response = [
            'status' => 'success',
            'message' => 'Trainer deleted successfully.'
        ];
        header('Content-Type: application/json');
        http_response_code(200);
        echo json_encode($response);
        exit;
    }


    // check if all fields are filled
    if (!isset($_POST['name']) || !isset($_POST['phone']) || !isset($_POST['email']) || !isset($_POST['specialization'])) {
        $response = [
            'status' => 'error',
            'message' => 'All fields are required.'
        ];
        header('Content-Type: application/json');
        http_response_code(400);
        echo json_encode($response);
        exit;
    }

    // update trainer details if method is PUT else insert new trainer details
    if ($_POST['_method'] === 'PUT') {
        $data = [
            'TrainerID' => $_POST['trainerid'],
            'Name' => $_POST['name'],
            'Phone' => $_POST['phone'],
            'Email' => $_POST['email'],
            'Specialization' => $_POST['specialization'],
        ];

        // update trainer details
        $db->query('UPDATE Trainer SET Name = :Name, Phone = :Phone, Email = :Email, Specialization = :Specialization WHERE TrainerID = :TrainerID', $data);
        $response = [
            'status' => 'success',
            'message' => 'Trainer updated successfully.'
        ];
        header('Content-Type: application/json');
        http_response_code(200);
        echo json_encode($response);
        exit;
    }


    $data = [
        'Name' => $_POST['name'],
        'Phone' => $_POST['phone'],
        'Email' => $_POST['email'],
        'Specialization' => $_POST['specialization'],
    ];
    // insert new trainer details
    $db->query('INSERT INTO Trainer (Name, Phone, Email, Specialization) VALUES (:Name, :Phone, :Email, :Specialization)', $data);
    $response = [
        'status' => 'success',
        'message' => 'Trainer added successfully.'
    ];
    header('Content-Type: application/json');
    http_response_code(200);
    echo json_encode($response);
    exit;
} else {

    $url = parse_url(($_SERVER['REQUEST_URI']))['path'];


    if ($url === '/getinstructors') {
        // get all trainer details from database and store in $instructors variable to be used in the view file instructors.view.php    
        $instructors = $db->query('SELECT DISTINCT
    TrainerID,
    Name,   
    Phone,
    Email,
    Specialization,
    (SELECT COUNT(*) FROM trainer) AS countInstructors FROM trainer;')->fetchAll(PDO::FETCH_ASSOC);
        $response = [
            'status' => 'success',
            'message' => 'Trainers retrieved successfully.',
            'data' => $instructors
        ];
        header('Content-Type: application/json');
        http_response_code(200);
        echo json_encode($response);
        exit;
    } else {
        // load the view file instructors.view.php
        require "views/instructors.view.php";
    }
}
