<?php 

$contactFile = '.contact.dat'; 

// ファイルを丸ごと読み込み
// $fileContents = file_get_contents($contactFile);
// echo $fileContents; 

// ファイルを書き込む（上書き）
// file_put_contents($contactFile, 'テストです'); 

// ファイルに書き込み（追記）
// file_put_contents($contactFile, 'テストです',FILE_APPEND ); 

// 改行で追記したい
// file_put_contents($contactFile, "\nテストです",FILE_APPEND ); 

// csv format ファイル操作
// 配列、file、クッギル
// $allData = file($contactFile); 

// foreach($allData as $lineData){
//     $lines = explode(',',$lineData); 
//     echo $lines[0].'<br>'; 
//     echo $lines[1].'<br>';
//     echo $lines[2].'<br>'; 
// }


// 行ごとで書き込むと読む込み
$contactFile = '.contact.dat';

$contents = fopen($contactFile, 'a+');

$addText = "\n".'1行追記' . "\n";

fwrite($contents, $addText);

fclose($contents);
