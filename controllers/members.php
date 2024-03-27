<?php

// Path: index.php

$heading = "Members";

$config = require('config.php');

$db = new Database($config['database']);

$members = $db->query('SELECT DISTINCT
    Member.MemberID,
    Member.Name,
    Member.Address,
    Member.Phone,
    Member.Email,
    Subscription.SubscriptionID,
    Subscription.StartDate,
    Subscription.EndDate,
    Subscription.Price,
    (SELECT COUNT(*) FROM Subscription WHERE EndDate < CURDATE()) AS countExpired,
    (SELECT COUNT(*) FROM Subscription WHERE EndDate >= CURDATE()) AS countActive
FROM 
    Member
LEFT JOIN 
    Subscription ON Member.MemberID = Subscription.MemberID;')->fetchAll(PDO::FETCH_ASSOC);


// dd($members);
require "views/members.view.php";
