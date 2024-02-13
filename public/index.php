<?php

require __DIR__ . "/../vendor/autoload.php";

use App\App;

$app = new App();

$app->run();
















// "App\\": "src/" указывает, что классы с префиксом App\ должны быть загружены из каталога src/. 
