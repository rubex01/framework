<?php

namespace Framework\Database;

interface DatabaseInterface {
    public function makeDatabaseConnection();

    public function connectionError(string $causeOfException);
}