<?php

namespace Framework\Database;

use Framework\Database\DatabaseInterface;

class Database 
{
    /**
     * Contains all database connections
     * 
     * @var array
     */
    public static $Connections = [];

    /**
     * Triggers connect function of specific database class
     * 
     * @param DatabaseInterface $databaseClass
     * @return void
     */
    public static function connect(DatabaseInterface $databaseClass) : void
    {
        $name = $databaseClass->getConnectionName();
        self::$Connections[$name] = $databaseClass->makeDatabaseConnection();
    }

    /**
     * Destroy database connection
     *
     * @param DatabaseInterface $databaseClass
     */
    public static function destroyConnection(DatabaseInterface $databaseClass) : void
    {
        $databaseClass->destroyConnection();
    }
}