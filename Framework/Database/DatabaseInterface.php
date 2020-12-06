<?php

namespace Framework\Database;

interface DatabaseInterface {
    /**
     * Makes database connection and returns it
     * 
     * @return object
     */
    public function makeDatabaseConnection();

    /**
     * Returns name of the connection
     *
     * @return string
     */
    public function getConnectionName();

    /**
     * In case of connection error trigger exception
     * 
     * @param string $causeOfException
     * @return void
     */
    public function connectionError(string $causeOfException);

    /**
     * Destroys the connection to the database
     *
     * @return void
     */
    public function destroyConnection();
}