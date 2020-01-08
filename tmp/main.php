<?php 
/**
 * В этом модуле происходит подключение основных частей выбранного шаблона:
 * 
 * Head.php    - заголовочная часть документа. В данном задании решил сделать единым для всех страниц
 * Ниже вёрстка основного меню(решил сделать его здесь неизменяемым,но ничего не мешает менять CSS). Так же(под основным меню), ниже расположен фильтр
 * для списка задач
 * Content.php - далее подключение шаблона с контентом(а в нём уже подключаются подшаблоны в зависимости от маршрута)
 * В подключаемых шаблонах раздела Content решил не объединять создание нового(задача или пользователь) с редактированием из имеющихся,
 * чтоб не усложнять код(в учебных примерах такое проделывал). Если надо, учебные примеры так же выложу
 * 
 * Footer.php  - Подвальная часть, одинаковая для всех страниц
 */ 
include $template.'/Head.php';
?>
<body>
<nav>
    <ul>
        <li 
        <?php
        if ($uri[0] == 'tasks') {
            echo 'class="listSelected"';
        }
        ?>
        ><a href="/tasks">Задачи</a></li>
        <li
        <?php
        if ($uri[0] == 'users') {
            echo 'class="listSelected"';
        }
        ?>
        ><a href="/users">Пользователи</a></li>
    </ul>
<?php
/**
 * Фильтр списка задач расположил здесь, чисто, чтоб файл не был слишком пустым(и панель в браузере тоже)
 */ 
if ($uri[0] == 'tasks' AND $uri[1] == 'list') {
    ?>
    <form action="" method="POST">
    <p>Фильтрация по текстовым полям</p>
    <select name="filterSelect">
        <option value="subj"
            <?php
                if (isset($_REQUEST['filterSelect']) AND $_REQUEST['filterSelect'] == 'subj')
                    echo "selected"
            ?>
        >Заголовок</option>
        <option value="text"
            <?php
                if (isset($_REQUEST['filterSelect']) AND $_REQUEST['filterSelect'] == 'text')
                    echo "selected"
            ?>
        >Текст</option>
    </select>
    Поле содержит:<br>
    <input name="filterString" value="<?php
            if (isset($_REQUEST['filterString'])) {
                echo $_REQUEST['filterString'];
            }
        ?>"
    ><br>
    Статус:
    <select name="filterStatus">
        <?php
    foreach ($statuses AS $status) {
        ?>
        <option value="<?php echo $status['id'] ?>"><?php echo $status['name'] ?></option>
        <?php
    }
    ?>
    </select>
    <p>Создана<br>
    С:</p>
    <table>
        <tr>
            <td><input type="date" name="filterCreateDateStart" value="<?php if (isset($timeFilter['filterCreateDateStart'])) echo $timeFilter['filterCreateDateStart'] ?>"></td>
            <td><input type="time" name="filterCreateTimeStart" value="<?php if (isset($timeFilter['filterCreateTimeStart'])) echo $timeFilter['filterCreateTimeStart'] ?>"></td>
        </tr>
    </table>
    <p>По:</p>
    <input type="date" name="filterCreateDateEnd" value="<?php if (isset($timeFilter['filterCreateDateEnd'])) echo $timeFilter['filterCreateDateEnd'] ?>">
    <input type="time" name="filterCreateTimeEnd" value="<?php if (isset($timeFilter['filterCreateTimeEnd'])) echo $timeFilter['filterCreateTimeEnd'] ?>">
    <p>Сделать до...<br>
    С:</p>
    <input type="date" name="filterDeadlineDateStart" value="<?php if (isset($timeFilter['filterDeadlineDateStart'])) echo $timeFilter['filterDeadlineDateStart'] ?>">
    <input type="time" name="filterDeadlineTimeStart" value="<?php if (isset($timeFilter['filterDeadlineTimeStart'])) echo $timeFilter['filterDeadlineTimeStart'] ?>">
    <p>По:</p>
    <input type="date" name="filterDeadlineDateEnd" value="<?php if (isset($timeFilter['filterDeadlineDateEnd'])) echo $timeFilter['filterDeadlineDateEnd'] ?>">
    <input type="time" name="filterDeadlineTimeEnd" value="<?php if (isset($timeFilter['filterDeadlineTimeEnd'])) echo $timeFilter['filterDeadlineTimeEnd'] ?>">
    <input type="hidden" name="filtering" value="true">
    <input type="submit" value="Применить">
    <a href="/tasks/list">Сброс</a>
    </form>
    <?php
}

?>
</nav>

<?php
if ($success)
include $template.'/Content.php';
else
include $template.'/404.php';
include $template.'/Footer.php';
?>
</body>
</html>

