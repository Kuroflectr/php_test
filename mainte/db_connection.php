<?php

// const DB_HOST = 'mysql:dbname=udemy_php;host=127.0.0.1;charset=utf8';
const DB_HOST = 'mysql:host=127.0.0.1;dbname=udemy_php;charset=utf8';
const DB_USER = 'root'; 
const DB_PASSWORD = ''; 

try{ 
    $pdo = new PDO(DB_HOST,DB_USER,DB_PASSWORD); 
    echo 'success'; 
}    catch( PDEException $e){
    echo 'warning: failed'.$e-> getMessage()."\n"; 
    exit(); 
}