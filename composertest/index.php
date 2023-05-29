<?php

require_once __DIR__ . '/vendor/autoload.php';

use Src\Controllers\TestController;


$app = new TestController;
$app->run();


use Carbon\Carbon;


echo '<br>';
echo Carbon::now(); 