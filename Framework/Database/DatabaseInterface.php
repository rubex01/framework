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
     * In case of connection error trigger exception
     * 
     * @param string $causeOfException
     * @return void
     */
    public function connectionError(string $causeOfException);
}