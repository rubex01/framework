<?php

include __DIR__ . '/../autoload.php';

class Create
{
    use \Framework\Commands\ConsoleErrorTrait;

    /**
     * Contains array of all the types that are in the json
     *
     * @var array $types
     */
    public static $types;

    /**
     * Contains string of wich type of file needs to be created
     *
     * @var string $createType
     */
    public static $createType;

    /**
     * Contains information about the file
     *
     * @var array $createInfo
     */
    public static $createInfo;

    /**
     * Contains name of the file
     *
     * @var string $createName
     */
    public static $createName;

    /**
     * Contains path where the file should be created
     *
     * @var string $createPath
     */
    public static $createPath;

    /**
     * Contains errors
     *
     * @var array $errors
     */
    public static $errors = [];

    /**
     * Init function of the create class
     *
     * @return void
     */
    public static function init() : void
    {
        self::$types = self::getAllTypes();
        $type = self::getType();
        self::getName();
        if ($type === true) self::createFile();

        if (count(self::$errors) > 0) {
            self::reportError();
        }
    }

    /**
     * Get all the possibble types from json file
     *
     * @return object
     */
    public static function getAllTypes() : object
    {
        return json_decode(file_get_contents(__DIR__ . '/CreateTemplates/CreateTypes.json'));
    }

    /**
     * Get type from user input
     *
     * @return bool
     */
    public static function getType() : bool
    {
        echo "What type of file do you want to generate? \n";
        echo "Choose one of the following: [";
        foreach (self::$types as $name => $info) {
            echo $name.', ';
        }
        echo "]: ";
        $handle = fopen ("php://stdin","r");
        $line = fgets($handle);
        if(!array_key_exists(trim($line), self::$types)){
            self::$errors[] = 'Could not generate this type because there was no existing template found.';
            return false;
        }
        fclose($handle);
        $input = trim($line);
        self::$createInfo = self::$types->$input;
        self::$createType = $input;
        return true;
    }

    /**
     * Get name from user input
     *
     * @return bool
     */
    public static function getName() : bool
    {
        echo "What do you want the name to be: ";
        $handle = fopen ("php://stdin","r");
        $line = fgets($handle);
        fclose($handle);
        self::$createName = trim($line);
        return true;
    }

    /**
     * Creates file
     *
     * @return bool
     */
    public static function createFile() : bool
    {
        $file = __DIR__ . '/CreateTemplates/'.self::$createType.'Template.php';
        $className = self::$createName . date('Ymdhms');
        include_once $file;
        $newFile = fopen(__DIR__ . '/../../'.self::$createInfo->path.'/' . $className . '.php', 'w');
        fwrite($newFile, $fileContent);
        return true;
    }
}

Create::init();
