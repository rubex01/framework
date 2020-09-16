<?php

namespace Framework\Database;

use mysqli;
use Framework\Database\DatabaseInterface;

class MySQL implements DatabaseInterface
{
    /**
     * Key of connection in database connections array
     * 
     * @var string
     */
    public $name = 'MySQL';

    /**
     * Contains database connection
     * 
     * @var object
     */
    public $Conn;

    /**
     * Contains servername
     * 
     * @var string
     */
    private $serverName;

    /**
     * Contains username
     * 
     * @var string
     */
    private $username;

    /**
     * Contains password
     * 
     * @var string
     */
    private $password;

    /**
     * Contains database name
     * 
     * @var string
     */
    private $dbName;

    /**
     * Make database connection
     * 
     * @return object
     */
    public function makeDatabaseConnection() : object
    {
        //todo:: get info from .env
        $this->serverName = 'localhost';
        $this->username = 'root';
        $this->password = '';
        $this->dbName = 'webshop_example';

        $this->Conn = new mysqli($this->serverName, $this->username, $this->password, $this->dbName);

        if ($this->Conn->connect_error) {
            $this->connectionError($this->Conn->connect_error);
        }
        
        return $this->Conn;
    }

    /**
     * Error handling in case of failed connection
     * 
     * @return void
     */
    public function connectionError(string $causeOfException) : void
    {
        //todo:: correct error handling
        echo $causeOfException;
        exit();
    }
}