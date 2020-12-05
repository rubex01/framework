<?php

namespace Framework\Commands\Cleanup;

use Framework\TemplateEngine\TemplateEngine;

class Cleanup
{
    use \Framework\Commands\DefaultTraits;

    public $keepFiles = ['.gitignore'];

    public function start()
    {
        $this->requestPermission();
        $this->cleanupFiles();
    }

    public function requestPermission()
    {
        $continue = self::requestInput('Are you sure you want to cleanup all the unused files?', ['(Y)es', '(N)o']);
        if ($continue != 'yes' && $continue != 'y') {
            echo "Alright, exiting cleanup mode.";
            exit();
        }
    }

    public function cleanupFiles()
    {
        $cleanupDirs = [
            __DIR__ . '/../../../Storage/Cache',
            __DIR__ . '/../../../Storage/App/CompiledTemplates',
        ];

        foreach ($cleanupDirs as $dir) {
            $this->deleteFilesInDir($dir);
        }

        echo "Cleanup finished, compiling all the needed templating files.\n";

        $runCompiler = new TemplateEngine();

        echo 'Template compiling has finished.';
    }

    public function deleteFilesInDir(string $dir)
    {
        foreach (glob("$dir/*") as $file) {
            if (is_dir($file)) {
                $this->deleteFilesInDir($file);
            } elseif (!in_array(basename($file), $this->keepFiles)) {
                unlink($file);
            }
        }
    }
}