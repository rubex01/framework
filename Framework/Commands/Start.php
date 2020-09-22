<?php

namespace Framework\Commands;

include __DIR__ . '/../autoload.php';

class Start
{
    use \Framework\Commands\ConsoleErrorTrait;

    /**
     * Contains all the errors that occurred
     *
     * @var array $errors
     */
    public static $errors = [];

    /**
     * Init function
     */
    public static function init()
    {
        self::createEnv();

        if (count(self::$errors) > 0) {
            self::reportError();
        }
    }

    /**
     * Create env file if needed
     *
     * @return bool
     */
    public static function createEnv()
    {
        if (file_exists(__DIR__ . '/../../.env.php'))  {
            self::$errors[] = 'There already is an .env file, to prevent overwriting this command is not executed.';
            return false;
        }
        if (copy(__DIR__ . '/../../.env.example.php',__DIR__ . '/../../.env.php')) return true;
    }
}

Start::init();