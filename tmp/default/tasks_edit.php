<form method="POST" act="">
<table>
<tr><td>Заголовок   </td><td><input name="subj" class="string" value="<?php echo $result[0]['subj'] ?>"></td></tr>
<tr><td>Текст       </td><td><textarea name="text" class="text"><?php echo $result[0]['text'] ?></textarea></td></tr>
<tr><td>Статус      </td><td>
<select name="status" class="select">
<?php
foreach ($statuses AS $elem) {
    ?>
    <option value="<?= $elem['id'] ?>"
    <?php
        if ($result[0]['statusId'] == $elem['id']) {
            echo 'selected="selected"';
        }
    ?>
    ><?= $elem['name'] ?></option>
    <?php
}
?>
</select>
</td></tr>
<tr><td>Исполнитель	</td><td>
<select name="user" class="select">
<option value="0">Не выбран</option>
<?php
foreach ($users AS $user) {
?>
<option value="<?= $user['id'] ?>"
<?php
    if ($result[0]['executorId'] == $user['id']) {
        echo 'selected="selected"';
    }
?>
><?= $user['FIO'] ?></option>
<?php
}
?>
</select>
</td></tr>
<tr><td>Сделать до:</td>
    <td>
        <input type="date" name="deadlineDate" value="<?php echo $result[0]['deadlineDate'] ?>"> 
        <input type="time" name="deadlineTime" value="<?php echo $result[0]['deadlineTime'] ?>">
    </td>
</tr>
<tr>
    <td>
        <input type="hidden" name="act" value="edit">
        <input type="hidden" name="id" value="<?php echo $result[0]['id'] ?>">
    </td>
    <td><input type="submit" value="Сохранить" class="button"></td></tr>
</table>
</form>
