<?php
if ($_SESSION["profile"] == null){
    echo '<a href="php/authorization_form.php">Авторизация</a>';
}
else{
    echo '<a href="php/session_stop.php">Выход</a>
                          <a href="php/my_article.php">Мои статьи</a>';
}
