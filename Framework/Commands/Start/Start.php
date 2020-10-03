<?php

namespace Framework\Commands\Start;

class Start
{
    /**
     * Start function
     *
     */
    public function start() : void
    {
        $this->createEnv();
    }

    /**
     * Create env file from env example
     *
     * @return void
     */
    public function createEnv() : void
    {
        echo (copy(__DIR__ . '/../../../.env.example.php',__DIR__ . '/../../../.env.php')) ? "You are all setup!" : "Something went wrong..";
    }
}