<?php

namespace Framework\CSRF;

use Framework\Request\Request;

class CSRF
{
    public static function init()
    {
        if (!isset($_COOKIE['CSRFtoken'])) {
            setcookie('CSRFToken', bin2hex(random_bytes(32)), time() + (86400 * 30), "/");
        }
    }

    public function checkCSRFtoken(Request $request)
    {
        $requestMethod = $request->requestMethod();

        if ($request->input('CSRFtoken') !== null) {
            if ($request->input('CSRFtoken') !== $_COOKIE['CSRFToken']) {
                //todo:: throw correct error
                echo 'error';
                exit();
            }
        }
        else if ($requestMethod === 'POST' || $requestMethod === 'PUT' || $requestMethod === 'PATCH') {
            //todo:: throw correct error
            echo 'There was no csrf token found on the form submission. Please disable csrf for this route or add a csrf token on the request body.';
            exit();
        }
    }
}


