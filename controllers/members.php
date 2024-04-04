<?php

// Path: members.php

// set the heading for the members management page
$heading = "Members Management";

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

    if ($_POST['_method'] === 'DELETE') {

        // delete member subscription details 
        $db->query('DELETE FROM Subscription WHERE MemberID = :MemberID', ['MemberID' => $_POST['id']]);
        // delete member details
        $db->query('DELETE FROM Member WHERE MemberID = :MemberID', ['MemberID' => $_POST['id']]);
        $response = [
            'status' => 'success',
            'message' => 'Member deleted successfully.'
        ];
        header('Content-Type: application/json');
        http_response_code(200);
        echo json_encode($response);
        exit;
    }

    // check if all fields are filled
    if (!isset($_POST['name']) || !isset($_POST['phone']) || !isset($_POST['email']) || !isset($_POST['address'])) {
        $response = [
            'status' => 'error',
            'message' => 'All fields are required.'
        ];
        header('Content-Type: application/json');
        http_response_code(400);
        echo json_encode($response);
        exit;
    }

    // check if method is PUT else insert new member details 
    if ($_POST['_method'] === 'PUT') {

        $data = [
            'MemberID' => $_POST['memberid'],
            'Name' => $_POST['name'],
            'Phone' => $_POST['phone'],
            'Email' => $_POST['email'],
            'Address' => $_POST['address'],
        ];

        // update member details
        $db->query('UPDATE Member SET Name = :Name, Phone = :Phone, Email = :Email, Address = :Address WHERE MemberID = :MemberID', $data);


        // $date = [
        //     'MemberID' => $_POST['memberid'],
        //     'StartDate' => $_POST['startdate'],
        //     'EndDate' => $_POST['enddate'],
        //     'Price' => $_POST['price'],
        // ];

        // // update member subscription details
        // $existingSubscription = $db->query('SELECT * FROM Subscription WHERE MemberID = :MemberID', ['MemberID' => $_POST['memberid']])->fetch(PDO::FETCH_ASSOC);

        // // check if member has existing subscription
        // if ($existingSubscription) {
        //     $db->query('UPDATE Subscription SET StartDate = :StartDate, EndDate = :EndDate, Price = :Price WHERE MemberID = :MemberID', $date);
        // } else {
        //     $db->query('INSERT INTO Subscription (MemberID, StartDate, EndDate, Price) VALUES (:MemberID, :StartDate, :EndDate, :Price)', $date);
        // }
        $response = [
            'status' => 'success',
            'message' => 'Member updated successfully.'
        ];
        header('Content-Type: application/json');
        http_response_code(200);
        echo json_encode($response);
        exit;
    }

    // insert new member details
    $data = [
        'Name' => $_POST['name'],
        'Address' => $_POST['address'],
        'Phone' => $_POST['phone'],
        'Email' => $_POST['email'],
    ];

    $db->query('INSERT INTO Member (Name, Address, Phone, Email) VALUES (:Name, :Address, :Phone, :Email)', $data);
    $response = [
        'status' => 'success',
        'message' => 'Member added successfully.'
    ];
    header('Content-Type: application/json');
    http_response_code(200);
    echo json_encode($response);
    exit;
} else {


    $url = parse_url(($_SERVER['REQUEST_URI']))['path'];

    if ($url === '/getmembers') {
        // get all member details from database and store in $members variable to be used in the view file members.view.php
        // get all member details from database and store in $members variable to be used in the view file members.view.php
        $members = $db->query('SELECT DISTINCT
        MemberID,
        Name,
        Address,
        Phone,
        Email,
        (SELECT COUNT(*) FROM member) AS countMembers FROM member;')->fetchAll(PDO::FETCH_ASSOC);


        $response = [
            'status' => 'success',
            'message' => 'Members retrieved successfully.',
            'data' => $members
        ];
        header('Content-Type: application/json');
        http_response_code(200);
        echo json_encode($response);
        exit;
    } else {
        // load the view file members.view.php
        require "views/members.view.php";
    }
}
