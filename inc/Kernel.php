<?php
    /**
     * Класс с методом, отправляющим запросы к API, плюс вспомогательные функции по подготовке данных
     */ 
class Kernel {
    /**
     * метод-обращение к API
     */ 
    public static function requestDB($uri, $params = []) {
        $vars = http_build_query($params);
        $options = array(
            'http' => array(
            'method'  => 'POST',  // метод передачи данных
                'header'  => 'Content-type: application/x-www-form-urlencoded',  // заголовок 
                'content' => $vars  // переменные
            )
        );
        $context = stream_context_create($options);  // создаём контекст потока
        $result = file_get_contents($uri, false, $context); //отправляем запрос
        return json_decode($result, true);
    }
    /**
     *  Простое приведение даты к нужному, для сохранения в Базе данных
     */ 
    public static function dateTimeToDB($date, $time)
    {
        return $date.' '.$time;
    }
    public static function filterPanelTimes($result, $request)
    {
        /**
         * Параметры по умолчанию для полей с датами, на панели фильтров
        */
        $filter = [];
        if ((!isset($request['filterCreateDateStart']) AND empty($request['filterCreateDateStart'])) 
        OR (!isset($request['filterCreateDateEnd']) AND empty($request['filterCreateDateEnd']))) {
            $filterCreateDateArray = [];
            foreach ($result AS $elem) {
                $filterCreateDateArray[] = $elem['created'];
            }
            $filterCreatedEnd = max($filterCreateDateArray);
            $filterCreatedStart = min($filterCreateDateArray);
            $filter['filterCreateDateStart'] = substr($filterCreatedStart,0,10);
            $filter['filterCreateTimeStart'] = substr($filterCreatedStart,11,8);
            $filter['filterCreateDateEnd'] = substr($filterCreatedEnd,0,10);
            $filter['filterCreateTimeEnd'] = substr($filterCreatedEnd,11,8);
        } else {
            $filter['filterCreateDateStart'] = $request['filterCreateDateStart'];
            $filter['filterCreateTimeStart'] = $request['filterCreateTimeStart'];
            $filter['filterCreateDateEnd'] = $request['filterCreateDateEnd'];
            $filter['filterCreateTimeEnd'] = $request['filterCreateTimeEnd'];
        }
        
        if ((!isset($request['filterDeadlineDateStart']) AND empty($request['filterDeadlineDateStart']))
        OR (!isset($request['filterDeadlineDateEnd']) AND empty($request['filterDeadlineDateEnd']))) {
            $filterDeadlineDateArray = [];
            foreach ($result AS $test) {
                if (isset($test['deadline'])) {
                    $filterDeadlineDateArray[] = $elem['deadline'];
                }
            }
            $filterDeadlineEnd = max($filterDeadlineDateArray);
            $filterDeadlineStart = min($filterDeadlineDateArray);
            $filter['filterDeadlineDateStart'] = substr($filterDeadlineStart,0,10);
            $filter['filterDeadlineTimeStart'] = substr($filterDeadlineStart,11,8);
            $filter['filterDeadlineDateEnd'] = substr($filterDeadlineEnd,0,10);
            $filter['filterDeadlineTimeEnd'] = substr($filterDeadlineEnd,11,8);
        } else {
            $filter['filterDeadlineDateStart'] = $request['filterDeadlineDateStart'];
            $filter['filterDeadlineTimeStart'] = $request['filterDeadlineTimeStart'];
            $filter['filterDeadlineDateEnd'] = $request['filterDeadlineDateEnd'];
            $filter['filterDeadlineTimeEnd'] = $request['filterDeadlineTimeEnd'];
        }
        
        return $filter;
    }
} 
