<?php 

require 'db_connection.php';

// // ユーザー入力なし query
// $sql = 'select * from contacts where id = 4'; //sql
// $stmt = $pdo->query($sql); //sql実行 ステートメント


// ユーザー入力あり prepare, bind, execute 悪意ユーザ delete * SQLインジェクション対策
$sql = 'select * from contacts where id = :id'; //名前付きプレースホルダ
$stmt = $pdo->prepare($sql);//プリペアードステートメント
// SQL文の「:id」を「5」に置き換えます。つまりはidが5より小さいレコードを取得します。
// PDO::PARAM_INTは、SQL INTEGER データ型を表します。
$stmt->bindValue('id', 5, PDO::PARAM_INT);//紐付け

// プリペアドステートメントを実行する
$stmt->execute(); 

$result = $stmt->fetchall();

echo '<pre>';
echo 'stmt'; 
echo '</pre>';
echo '<pre>';
var_dump($stmt);
echo '</pre>';

echo 'result'; 
echo '<pre>';
var_dump($result); 
echo '</pre>';