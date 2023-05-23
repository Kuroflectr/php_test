<?php

// CSRF 対策
// 例：偽物のinput.php -> 悪意のあるページ
session_start(); 

// バリデーション
// 別ファイルにします
require "validation.php"; 

// XSS対策
// 例：<script>alert('attack');<script>
function h($str)
{
	return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}


$text = "＄_POSTの確認↓"; 
echo '<pre>'; 
echo $text; 
echo "<br>"; 
echo '------------'; 
echo '</pre>'; 


if (!empty($_POST)){
    echo '<pre>'; 
    var_dump($_POST); 
    echo '</pre>'; 
}


$pageFlag = 0;
$errors = validation($_POST); 


if(!empty($_POST['btn_confirm']) && empty($errors)){
  $pageFlag = 1;
}
if(!empty($_POST['btn_submit'])){
  $pageFlag = 2;
}

?>




<!doctype html>
<html lang="en">
  <head>
    <!-- bootstap でレイアウトを弄る -->
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
<body>

<!--============================= -->
<!-- 最初のページ、内容を入力する -->
<!--============================= -->

<?php if($pageFlag === 0 ) : ?>

<!-- XSS対策 -->
<!-- 合言葉（tokenの作成） -->
<?php
if(!isset($_SESSION['csrfToken'])){
    $csrfToken = bin2hex(random_bytes(32));
    $_SESSION['csrfToken'] = $csrfToken; 
} 
$token = $_SESSION['csrfToken']; 
?>
<?php if(!empty($errors) && !empty($_POST['btn_confirm'])):?>
<?php echo '<ul>'; ?> 
<?php 
    foreach($errors  as $error ){
        echo "<li>". $error . "</li>"; 
    }
?> 
<?php echo '</ul>';  ?>
<?php endif ;?>



<form method="POST" action="input.php">
<div class="form-group">
    <label for="your-name">氏名</label>
    <input type="text" class="form-control" id="your-name" name="your_name" value="<?php if(!empty($_POST['your_name'])){echo h($_POST['your_name']);}?>" required >
</div>
メールアドレス
<input type="email" name="email" value="<?php if(!empty($_POST['email'])){echo h($_POST['email']);}?>">
<br>

<!-- バリディション -->
ホームページ
<input type="url" name="url" value="<?php if(!empty($_POST['url'])){echo h($_POST['url']);}?>">
<br>
性別
<input type="radio" name="gender" value="0" 
<?php if(!empty($_POST['gender']) && $_POST['gender'] === '0')
{echo 'checked'; } ?>>男性
<input type="radio" name="gender" value="1" 
<?php if(!empty($_POST['gender']) && $_POST['gender'] === '1')
{echo 'checked'; } ?>>女性
<br>
年齢
<select name="age">
    <option value="">選択してください</option>
    <option value="1" 
    <?php if(!empty($_POST['age']) && $_POST['age'] === '1')
        {echo 'selected'; } ?>>〜19歳</option>
    <option value="2" 
    <?php if(!empty($_POST['age']) && $_POST['age'] === '2')
        {echo 'selected'; } ?>>20歳〜29歳</option>
    <option value="3"
    <?php if(!empty($_POST['age']) && $_POST['age'] === '3')
        {echo 'selected'; } ?>>30歳〜39歳</option>
    <option value="4"
    <?php if(!empty($_POST['age']) && $_POST['age'] === '4')
        {echo 'selected'; } ?>>40歳〜49歳</option>
    <option value="5"
    <?php if(!empty($_POST['age']) && $_POST['age'] === '5')
        {echo 'selected'; } ?>>50歳〜59歳</option>
    <option value="6"
    <?php if(!empty($_POST['age']) && $_POST['age'] === '6')
        {echo 'selected'; } ?>>60歳〜</option>
</select>
<br>
お問合せ内容
<textarea  name="contact">
<?php if(!empty($_POST['contact'])){echo h($_POST['contact']);}?>
</textarea>
<br>
<input type="checkbox" name="caution" value="1">注意事項にチェックする
<br>

<input type="submit" name="btn_confirm" value="確認する">

<!-- csrf tokenの値をこっちに保存する -->
<!-- super global変数のcsrfで保存 -->
<!-- typeはhiddenに設定すると、ブラウザのソースを表示のところで表示されちゃうのでパスワードを設定しないように -->
<input type='hidden' name='csrf' value="<?php echo $token; ?>">
</form>
<?php endif; ?>



<!--============================= -->
<!-- 内容を送信し、確認用のページ -->
<!--============================= -->

<?php if($pageFlag === 1 ) : ?>
<!-- csrf tokenの値をこっちに確認する -->
<?php if($_POST['csrf'] === $_SESSION['csrfToken']):?>

<form method="POST" action="input.php">
氏名
<?php echo h($_POST['your_name']);?>
<br>
メールアドレス
<?php echo h($_POST['email']);?>
<br>
ホームページ
<?php echo h($_POST['url']);?>
<br>
性別
<?php 
    if($_POST['gender'] === "0"){echo "男性"; }
    if($_POST['gender'] === "1"){echo "女性"; }
?>
<br>
年齢
<?php
  if($_POST['age'] === '1'){ echo '〜19歳' ;}
  if($_POST['age'] === '2'){ echo '20歳〜29歳' ;}
  if($_POST['age'] === '3'){ echo '30歳〜39歳' ;}
  if($_POST['age'] === '4'){ echo '40歳〜49歳' ;}
  if($_POST['age'] === '5'){ echo '50歳〜59歳' ;}
  if($_POST['age'] === '6'){ echo '60歳〜' ;}
?>
<br>
お問い合わせ内容
<br>
<?php echo h($_POST['contact']);?>
<br>

<input type="submit" name="back" value="戻る">
<input type="submit" name="btn_submit" value="送信する">
<input type="hidden" name="your_name" value="<?php echo h($_POST['your_name']);?>">
<input type="hidden" name="email" value="<?php echo h($_POST['email']);?>">
<input type="hidden" name="url" value="<?php echo h($_POST['url']);?>">
<input type="hidden" name="gender" value="<?php echo h($_POST['gender']);?>">
<input type="hidden" name="age" value="<?php echo h($_POST['age']);?>">
<input type="hidden" name="contact" value="<?php echo h($_POST['contact']);?>">
<input type="hidden" name="csrf" value="<?php echo h($_POST['csrf']);?>">
</form>
<?php endif; ?>
<?php endif; ?>




<!--============================= -->
<!-- 最後のページ、内容を送信したと伝える用 -->
<!--============================= -->
<?php if($pageFlag === 2 ) : ?>
<!-- csrf tokenの値をこっちに確認する -->
<?php if($_POST['csrf'] === $_SESSION['scrfToken']):?>
送信が完了しました。
<!-- csrf tokenを削除する -->
<?php unset($_SESSION['scrfToken']); ?>
<?php endif; ?>
<?php endif; ?>

    <!-- bootstrapでレイアウトを弄る -->
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->

</body>
</html>

