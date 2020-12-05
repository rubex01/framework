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
    public static function view(string $viewLayout, string $viewPage, array $dataToPassOn, bool $cacheEnabled = false) : void
    {
        extract($dataToPassOn);
        $renderPage = __DIR__ . '/../../Storage/App/CompiledTemplates/Pages/' . $viewPage . '.page.php';
        $cacheName = md5($viewLayout . $viewPage);

        if (getenv('CACHING') == true && $cacheEnabled === true && file_exists(__DIR__ . '/../../Storage/Cache/'.$cacheName.'.html') === true) {
            $time = filectime(__DIR__ . '/../../Storage/Cache/' . $cacheName . '.html');
            
            if (date("Y-m-d H:i:s.", $time) > date('Y-m-d H:i:s', strtotime("-1 day", strtotime(date("Y/m/d"))))) {
                include __DIR__ . '/../../Storage/Cache/' . $cacheName . '.html';
                return;
            }
        }

        ob_start();
        include(__DIR__ . '/../../Storage/App/CompiledTemplates/Layouts/' . $viewLayout . '.layout.php');
        $content = ob_get_clean();

        if ($cacheEnabled) {
            $cacheFile = fopen(__DIR__ . '/../../Storage/Cache/' . $cacheName . '.html', "w");
            fwrite($cacheFile, $content);
            fclose($cacheFile);
        }

        echo $content;
    }
}