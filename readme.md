FrontController - точка входа - [public|web]/index.php

$_SERVER['REQUEST_URI'] - получаем строку в браузере после доменного имени: /posts/create
trim($_SERVER['REQUEST_URI'], '/') - убираем слева и справа slashes: posts/create

У нас должен быть класс Router с двумя свойствами: routes = [] и route = []

Regexp для главной страницы: '^$'
Regexp для остальных страниц: '([a-z-]+)/([a-z-]+)' - controller/action