<?php

$title = "Logout";
$redirect = '.';
setcookie("pass","",time() - 3600);


include 'tpl/header.tpl';

echo '<div class="msg">Logout!<br/>You will redirect to the main page after 2 seconds.</div>';
echo '<div class="msg"><a href = "./">Home</div>';
// echo 'Logout!<br/><a href="./">Home</a>';

include 'tpl/footer.tpl';

?>