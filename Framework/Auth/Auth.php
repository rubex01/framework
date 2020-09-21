<?php

namespace Framework\Auth;

use Framework\Database\Database;
use Framework\Auth\ExtraAuthMethods;

class Auth
{
    use ExtraAuthMethods;

    public static $user;

    public static $id;

    private static $passwordHash;

    protected static $database;

    protected static $deviceFingerPrint;

    public static $authStatus;

    /**
     * Auth constructor.
     *
     * @return void
     */
    public function __construct()
    {
        self::$database = reset(Database::$Connections);
        self::$deviceFingerPrint = self::getDeviceFingerprint();
        self::$authStatus = self::initialAuthCheck();
    }

    /**
     * Checks the authentication status
     *
     * @return bool
     */
    public static function check() : bool
    {
        return self::$authStatus;
    }

    /**
     * Logs the user out and removes the session
     *
     * @return bool
     */
    public static function logout() : bool
    {
        $stmt = self::$database->prepare('DELETE FROM user_sessions WHERE token = ?');
        $stmt->bind_param("s", $_COOKIE['token']);
        $stmt->execute();
        unset($_COOKIE['token']);
        setcookie('token', null, -1, '/');
        return true;
    }

    /**
     * Logs user in
     *
     * @param array $user
     * @return bool
     */
    public static function login(array $user) : bool
    {
        $userData = self::getUserData('email', $user['email']);
        if (password_verify($user['password'], $userData['password'])) {
            if (self::generateLogin($userData) !== true) {
                return false;
            }

            unset($userData['password']);
            self::$user = $userData;
            self::$id = $userData['user_id'];
            return true;
        }
        return false;
    }

    /**
     * Logs out all the other devices
     *
     * @param string $password
     * @return bool
     */
    public static function logoutOtherDevices(string $password) : bool
    {
        if (!password_verify($password, self::$passwordHash)) {
            return false;
        }
        $stmt = self::$database->prepare('DELETE FROM user_sessions WHERE user_id = ? AND token <> ?');
        $stmt->bind_param("ss", self::$id, $_COOKIE['token']);
        $stmt->execute();
        return true;
    }


}