<?php

ini_set('memory_limit', -1);

require dirname(__DIR__) . '/vendor/autoload.php';

$app = new \App\Application();
$app->main();