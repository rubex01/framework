<?php

namespace Framework\Pages;

class Pages
{
    /**
     * view function that returns page in layout
     * 
     * @param string $viewLayout
     * @param string $viewPage
     * @param array $dataToPassOn
     * @return void
     */
    public static function view(string $viewLayout, string $viewPage, array $dataToPassOn) : void
    {
        $data = $dataToPassOn;
        $page = __DIR__ . '/../../Views/Pages/' . $viewPage . '.page.php';

        ob_start();
        include(__DIR__ . '/../../Views/Layouts/' . $viewLayout . '.layout.php');
        $content = ob_get_clean();

        echo $content;

        //todo:: cache the content and return that if needed
    }
}