<?php

namespace Framework\Commands;

trait ConsoleErrorTrait {
    /**
     * Report the errors if any occured
     */
    public static function reportError()
    {
        foreach (self::$errors as $error) {
            echo "$error...\n";
        }
    }
}