<?php

// const DB_HOST = 'mysql:dbname=udemy_php;host=127.0.0.1;charset=utf8';
const DB_HOST = 'mysql:host=127.0.0.1;dbname=udemy_php;charset=utf8';
const DB_USER = 'root'; 
const DB_PASSWORD = ''; 
// $driver_options = [
//     変更したい属性 => 値,
//     変更したい属性 => 値,
// ];
$driver_options = [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, 
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
    PDO::ATTR_EMULATE_PREPARES => false, 
];

try{ 
    $pdo = new PDO(DB_HOST,DB_USER,DB_PASSWORD, $driver_options); 
    echo '接続成功'; 
} catch( PDEException $e){
    echo '接続失敗'.$e-> getMessage()."\n"; 
    exit(); 
}