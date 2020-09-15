<?php

namespace Framework\CSRF;

class CSRF
{
    public static function init()
    {
        if (!isset($_COOKIE['CSRFtoken'])) {
            setcookie('CSRFToken', bin2hex(random_bytes(32)), time() + (86400 * 30), "/");
        }
    }

    public function checkCSRFtoken()
    {
        if (isset($_POST['CSRFtoken'])) {
            if ($_POST['CSRFtoken'] !== $_COOKIE['CSRFToken']) {
                //todo:: throw correct error
                echo 'error';
                exit();
            }
        }
    }
}


