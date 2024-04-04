<?php

// routes.php
// This file contains the routes for the application.
// The key is the route and the value is the controller file that will be executed when the route is visited.


return [
    '/' => 'controllers/index.php',
    '/members' => 'controllers/members.php',
    '/instructors' => 'controllers/instructors.php',
    '/equipment' => 'controllers/equipment.php',
    '/about' => 'controllers/about.php'
];
