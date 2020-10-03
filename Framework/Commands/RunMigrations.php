<?php

use Framework\Database\Database;

include __DIR__ . '/../autoload.php';

class Run
{
    use \Framework\Commands\ConsoleErrorTrait;

    /**
     * Contains the directory witch contains all the migrations are
     *
     * @var string $migrationDir
     */
    public static $migrationDir = __DIR__ . '/../../Migrations';

    /**
     * Contains array of all the migration files
     *
     * @var array $migrationFiles
     */
    public static $migrationFiles;

    /**
     * Contains method of the migration
     *
     * @var string $migrationMethod
     */
    public static $migrationMethod;

    /**
     * Contains all the errors
     *
     * @var array $errors
     */
    public static $errors = [];

    /**
     * Init function
     */
    public static function init()
    {
        $scanDir = scandir(__DIR__ . '/../../Databases', SCANDIR_SORT_DESCENDING);
        $databases = array_diff($scanDir, array('.', '..'));

        foreach ($databases as $key => $database) {
            $databases[$key] = basename($database, '.php');
        }

        if (count($databases) > 1) {
            $chosenDatabase = self::chooseDatabase($databases);
            $dbClass =  'Databases\\'.$chosenDatabase;
            $database = new $dbClass;
        }
        else {
            $dbClass =  'Databases\\'.$databases[0];
            $database = new $dbClass;
        }

        Database::connect($database);


        $method = self::getMigrationMethod();
        self::$migrationFiles = self::getMigrationFiles();
        if ($method === true) self::runMigrations();

        if (count(self::$errors) > 0) {
            self::reportError();
        }
    }

    /**
     * Let user choose database when there is more then one
     *
     * @param array $databases
     * @return string
     */
    public static function chooseDatabase(array $databases)
    {
        echo 'There are multiple databases in the Database folder. Choose one of the following to migrate to: [';
        foreach ($databases as $key => $database) {
            echo $key === count($databases)-1 ? $database . ']: ' : $database . ', ';
        }
        $handle = fopen ("php://stdin","r");
        $line = fgets($handle);
        if(!in_array(trim($line), $databases)){
            self::$errors[] = 'The specified database could not be found in the database folder.';
            self::reportError();
            exit();
        }
        return trim($line);
    }

    /**
     * Get all the migration files from the migration dir
     *
     * @return array
     */
    public static function getMigrationFiles() : array
    {
        $getFiles = array_slice(scandir(self::$migrationDir), 2);

        $sortedArray = [];

        foreach ($getFiles as $key => $file) {
            $sortedArray[] = ['time' => substr($file, -18, 14), 'file' => $file];
        }

        usort($sortedArray, function($a, $b) {
            return $a['time'] <=> $b['time'];
        });

        foreach ($sortedArray as $key => $sortedArrayItem) {
            $sortedArray[$key] = $sortedArrayItem['file'];
        }

        return (self::$migrationMethod === 'up') ? array_reverse($sortedArray) : $sortedArray;
    }

    /**
     * Get the migration method from the user input
     *
     * @return bool
     */
    public static function getMigrationMethod() : bool
    {
        echo 'Please fill in the method you want to use on your migrations. Use one of the following [up, down]: ';
        $handle = fopen ("php://stdin","r");
        $line = fgets($handle);
        if(trim($line) !== 'up' && trim($line) !== 'down'){
            self::$errors[] = 'Please use either the method up or down.';
            return false;
        }
        fclose($handle);
        self::$migrationMethod = trim($line);
        return true;
    }

    /**
     * Run migration of user for every migration file with specified method
     */
    public static function runMigrations()
    {
        foreach (self::$migrationFiles as $file) {
            require self::$migrationDir.'/'.$file;

            $className = 'Migrations\\'.substr($file, 0, -4);
            $run = new $className;
            $method = self::$migrationMethod;
            $run->$method();
        }
    }
}

Run::init();