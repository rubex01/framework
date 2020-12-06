<?php

foreach (\Framework\Database\Database::$Connections as $connection) {
    \Framework\Database\Database::destroyConnection($connection);
}