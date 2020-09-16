<?php

namespace Framework\CSRF;

use Framework\Request\Request;

class CSRF
{
    /**
     * Check if the cookie isset if not generate one
     * 
     * @return void
     */
    public static function init() : void
    {
        if (!isset($_COOKIE['CSRFtoken'])) {
            setcookie('CSRFToken', bin2hex(random_bytes(32)), time() + (86400 * 30), "/");
        }
    }

    /**
     * Check if CSRF token is correct and if it is sent with the form
     * 
     * @param Request $request
     * @return void
     */
    public function checkCSRFtoken(Request $request) : void
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


