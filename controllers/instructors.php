<?php

// Path: index.php

$heading = "Instructors";


$config = require('config.php');

$db = new Database($config['database']);

$instructors = $db->query('SELECT DISTINCT
    TrainerID,
    Name,   
    Phone,
    Email,
    Specialization,
    (SELECT COUNT(*) FROM trainer) AS countInstructors
FROM
trainer;')->fetchAll(PDO::FETCH_ASSOC);



// dd($members);

require "views/instructors.view.php";
