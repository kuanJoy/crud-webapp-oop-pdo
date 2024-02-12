<?php
const APP_PATH = __DIR__;

require APP_PATH . "/vendor/autoload.php";

use App\App;

$app = new App();

$app->run();
















// "App\\": "src/" указывает, что классы с префиксом App\ должны быть загружены из каталога src/. 
