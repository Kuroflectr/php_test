<!DOCTYPE html>
<?php
if(!empty($_POST)){
    echo "<pre>"; 
    var_dump($_POST); 
    echo "</pre>"; 
} 

// using $_<method name>
?> 
<meta charset="utf-8">
<head></head>
<body>


<!-- GET -->
<form method="POST" action="input.php">
氏名
<input type="text" name="your_name">
<br>
<input type="checkbox" name="sports[]", value="野球">野球
<input type="checkbox" name="sports[]", value="サッカー">サッカー
<input type="checkbox" name="sports[]", value="バスケ">バスケ

<input type="submit" value="送信">
</form>


</body>
</html>

