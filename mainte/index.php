<?php 

require 'db_connection.php';


// トランザクション処理 まとまって処理
// 一連の処理が中断せずにまとまって処理
// ex)銀行 残高を確認->Aさんから引き落とし->Bさんに振込、途中で中断しないように
// beginTransaction, commit, rollback（最初に戻る）

$sql = 'SELECT * FROM contracts WHERE id = :id'; 


$result = $stmt->fetchall(); 


// トランザクション処理を開始
$pdo->beginTransaction()

try{

    //sql処理
    $stmt = $pdo->prepare($sql); 
    // PDO::PARAM_INTは、SQL INTEGER データ型を表します。
    $stmt->bindValue('id',3,PDO::PARAM_INT);
    $stmt->execute(); 
    $pdo->commit();

} catch(PDOException $e){
    // 更新のキャンセル
    $pdo->rollback(); 
}
