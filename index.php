<?php

$url = 'posts';
$regexp = '(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?';

preg_match("#$regexp#", $url, $matches);


$string = 'posts view';

echo ucwords($string);
echo PHP_EOL;