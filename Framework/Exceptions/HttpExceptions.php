<?php

namespace Framework\Exceptions;

use Exception;
use Framework\Pages\Pages;

class HttpExceptions extends Exception
{
    public function __construct($message, $code = 0)
    {

        $this->$message = $message;
        $this->$code = $code;

        parent::__construct($message, $code);

        $this->returnCustomError();
    }

    public function returnCustomError()
    {
        header(trim("HTTP/1.0 $this->code"));
        return Pages::view('default', 'error', [
            'title' => 'Error: '.$this->message,
            'code' => $this->code,
            'message' => $this->message,
            'trace' => array_reverse($this->getTrace())
        ]);
    }

    public function __toString()
    {
        return '';
    }
}
