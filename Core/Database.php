<?php

// connect to database and excute query

class Database
{
    // create a connection property
    public $connection;

    // create a constructor method
    public function __construct($config, $username = 'root', $password = '')
    {

        // create a dsn string
        $dsn = 'mysql:' . http_build_query($config, '', ';');

        // create a new PDO connection
        $this->connection = new PDO($dsn, $username, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    }

    // create a query method
    public function query($query, $params = [])
    {
        // prepare the query
        $statement = $this->connection->prepare($query);

        // execute the query
        $statement->execute($params);

        // return the statement
        return $statement;
    }
}
