<?php
/**
 * Взаимодействие с API сервера и формирование данных для отображения
 * $result   - массив   - данные из базы данных
 * $title    - строчное - заголовок для макета
 * $statuses - массив   - доп. переменная со списком статусов при создании и редактировании задач
 * $timeFilter - массив - данные(дата, время) для отображения на панели фильтров, в списке задач
 */
$result = [];
$title = '';
$success = true;
switch ($uri[0]) {
    /**
     * Раздел с задачами
     */ 
    case 'tasks':
    $statuses = Kernel::requestDB($server.'/statuses/');
    $users = Kernel::requestDB($server.'/users/list');
    switch ($uri[1]) {
        /**
         * Список с задачами
         */ 
        case 'list':
            $result = Kernel::requestDB($routeContr, $_REQUEST);
            $title = 'Список задач';
            $timeFilter = Kernel::filterPanelTimes($result, $_REQUEST);
            break;
        /**	
         * Создание новой задачи
         */ 
        case 'new':
        /**
         * Обработка отправленного запроса
         */
            if (isset($_REQUEST['act' ]) AND $_REQUEST['act'] == 'new') {
                $request = $_REQUEST;
                $request['deadline'] = Kernel::dateTimeToDB($request['deadlineDate'], $request['deadlineTime']);
                $result = Kernel::requestDB($routeContr, $request);
                header('Location: /tasks');
            }
                $title = 'Новая задача';
            break;
            /**
             * Редактирование имеющейся задачи
             */ 
        case 'edit':
            /**
            * Обработка отправленного запроса
            */
            if (isset($_REQUEST['act' ]) AND $_REQUEST['act'] == 'edit') {
                $request = $_REQUEST;
                $request['deadline'] = Kernel::dateTimeToDB($request['deadlineDate'], $request['deadlineTime']);
                $result = Kernel::requestDB($routeContr, $request);
                header('Location: /tasks');
            }
                $title = 'Редактирование задачи';
                $id = (int)$uri[2];
                $param = ['id' => $id];
                $result = Kernel::requestDB($routeContr, $param);
                /** 
                 * разделил input даты с временем, на 2 части для лучшей поддержки
                 */
                $result[0]['deadlineDate'] = substr($result[0]['deadline'],0,10);
                $result[0]['deadlineTime'] = substr($result[0]['deadline'],11,8);
            break;
            /**
             * Удаление задачи
             */ 
        case 'delete':
            if (isset($uri[2])) {
                $result = Kernel::requestDB($routeContr);
                header('Location: /tasks');
                die();
            }
            
            break;
    }
    break;
    /**
     * Раздел по работе с пользователями(исполнителями)
     * ветвление аналогично разделу с задачами
     */ 
    case 'users':
    switch ($uri[1]) {
        case 'list':
            $result = Kernel::requestDB($routeContr);
            $title = 'Список пользователей';
            break;
        case 'new':
            if (isset($_REQUEST['act'])) {
                $users = Kernel::requestDB($routeContr, $_REQUEST);
                header('Location: /users');	
            } else {
                $title = 'Новый пользователь';
                $users = Kernel::requestDB($routeContr);
            }
            break;
        case 'edit':
            if (isset($_REQUEST['act']) AND $_REQUEST['act'] == 'edit') {
                $result = Kernel::requestDB($routeContr, $_REQUEST);
                header('Location: /users');
            } else {
                $id = (int)$uri[2];
                $param = ['id' => $id];
                $result = Kernel::requestDB($routeContr, $param);
                $title = 'Изменение пользователя';
                if (!$result) {
                    header('Location: /users/new');
                }
            }
            break;
            /**
             * Если пользователь назначен исполнителем(по крайней мере, 
             * хоть в 1 задаче - удаление не произойдёт, пока не произойдёт переназначение исполнителя или 
             * удаления задачи)
             */ 
            case 'delete':
                if (isset($uri[2]))
                $uriParam = ['uriParam' => $uri];
                $result = Kernel::requestDB($routeContr.'/'.$uri[2], $uriParam);
                header('Location: /users');
        default:
        /**
         * Метка успешности - не большая защита при попытке ввести не правильную uri
         */ 
        $success = false;
        break;
    }
    break;
    /**
     * здесь та же задача с не правильной uri
     */ 
    default:
     $success = false;
    break;
}
