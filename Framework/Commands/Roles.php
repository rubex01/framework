<?php

namespace Framework\Commands;

include __DIR__ . '/../autoload.php';

class Roles
{
    public static $rolesJson = '{
    "roles": [
        "super_admin",
        "admin",
        "user"
    ],
    "actions": {
        "ADMIN_PANEL": [
            0,
            1
        ],
        "BLOCK_USER": [
            0,
            1,
            2
        ]
    }
}';

    /**
     * Init function
     */
    public static function init () {
        self::createRolesJson();
    }

    /**
     *
     *
     * @return bool
     */
    public static function createRolesJson()
    {
        if (!file_exists(__DIR__ . '/../../Roles.json')) {
            $newFile = fopen(__DIR__ . '/../../Roles.json', 'w');
            fwrite($newFile, self::$rolesJson);
            return true;
        }
        echo 'There already is a roles file, please use this one. It is located in the root of the project.';
        return false;
    }
}

Roles::init();