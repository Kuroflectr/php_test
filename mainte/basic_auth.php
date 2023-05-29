<?php

//パスワードを記録したファイルの場所
echo 'パスワードを記録したファイルの場所';
echo '<br>'
echo __FILE__;
// /Applications/MAMP/htdocs/php_test/mainte/test.php

echo '<br>';
//パスワード(暗号化)
echo(password_hash('password123', PASSWORD_BCRYPT));
// $2y$10$SXwlPwmcIbm5uKNtn65ad.denaT1p.axYht21HUhvpcpu3M3raE8m
