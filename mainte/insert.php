<?php

// DB 接続　PDO
function insertContact($request){
    require 'db_connection.php'; 

    // // 入力　DB保存　prepare, bind, execute(配列)
    // $params = [
    //     'id' => null,
    //     'your_name' => 'なまえ123',
    //     'email' => 'test@test.com',
    //     'url' => 'http://test.com',
    //     'gender' => '1',
    //     'age' => '2',
    //     'contact' => 'いいい',
    //     'created_at' => null
    // ];


    // 入力　DB保存　prepare, bind, execute(配列)
    $params = [
        'id' => null,
        'your_name' => $request['your_name'],
        'email' => $request['email'],
        'url' => $request['url'],
        'gender' => $request['gender'],
        'age' => $request['age'],
        'contact' => $request['contact'],
        'created_at' => null
    ];
    
    
    $count = 0;
    $columns = '';
    $values = '';

    foreach(array_keys($params) as $key){
    if($count++>0){
        $columns .= ',';
        $values .= ',';
    }
    $columns .= $key;
    $values .= ':'.$key;
    }

    $sql = 'insert into contacts ('. $columns .')values('. $values .')';


    // INSERT INTO `contacts` (`id`, `your_name`, `email`, `url`, `gender`, `age`, `contact`, `created_at`) VALUES (NULL, 'ike', 'ike.kuroflectr@gmail.com', 'https://test2.test2', '1', '3', 'how', current_timestamp());
    $sql = 'INSERT INTO contacts ('. $columns. ')values(' .$values. ')' ; 

    // echo '<br>'; 
    // echo $sql; 
    // echo '<br>'; 
    // exit;  

    $stmt = $pdo->prepare($sql);//プリペアードステートメント
    $stmt->execute($params); //実行

} 