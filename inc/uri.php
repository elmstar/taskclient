<?php
/**
 * Формирование(корректировка) переменной с параметрами из ЧПУ, 
 * а так же переменные, связанные с маршрутом и запросами
 * $uri - массив - содержит элементы маршрута
 * $routeContr - строка - предназначена, в основном для контроллера(controller.php)
 * $routeAction - строка -  в основном, предназначена для "кнопок" на формах в шаблонах
 */
$uri = explode('/',trim(preg_replace('#(\?.*)#','',$_SERVER['REQUEST_URI']),'/'));
if (empty(trim($uri[0]))) $uri[0] = 'tasks';
if (!isset($uri[1])) $uri[1] = 'list';
$routeContr = $server.$uri[0].'/'.$uri[1];
if (($uri[1] == 'edit' AND isset($uri[2])) OR ($uri[1] == 'delete' AND isset($uri[2])))
    $routeContr .= '/'.$uri[2];
$routeAction = '/'.$uri[0].'/'; // вспомогательная переменная для кнопок действия
$request = $_REQUEST; // данные, полученые из GET/POST запросов, переводим в обрабатываемую переменную
