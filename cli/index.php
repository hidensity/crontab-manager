<?php

define(
    'PROJECT_BASE_DIR',
    realpath(
        __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR
    ) . DIRECTORY_SEPARATOR
);
set_include_path(get_include_path() . PATH_SEPARATOR . PROJECT_BASE_DIR);

use Dbb\TestCrontabManager;

try {
    require 'vendor/autoload.php';

    $app = new TestCrontabManager();
    $app->run();
} catch (\Exception $ex) {
    throw $ex;
}
