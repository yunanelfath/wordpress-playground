<?php

spl_autoload_register(function ($class) {
    // Only load our plugin's namespace
    if (strpos($class, 'SchoolManager\\') !== 0) {
        return;
    }

    $path = str_replace('SchoolManager\\', '', $class);
    $path = str_replace('\\', DIRECTORY_SEPARATOR, $path);

    $file = __DIR__ . '/' . $path . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
});
