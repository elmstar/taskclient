<form method="POST" act="">
<table>
<tr><td>Заголовок   </td><td><input name="subj" class="string"></td></tr>
<tr><td>Текст       </td><td><textarea name="text" class="text"></textarea></td></tr>
<tr><td>Статус      </td><td>
<select name="status" class="select">
<?php
foreach ($statuses AS $elem) {
    ?>
    <option value="<?= $elem['id'] ?>"><?= $elem['name'] ?></option>
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
<option value="<?= $user['id'] ?>"><?= $user['FIO'] ?></option>
<?php
}
?>
</select>
</td></tr>
<tr><td>Сделать до:</td>
    <td>
        <input type="date" name="deadlineDate" value=""> 
        <input type="time" name="deadlineTime" value="">
    </td>
</tr>
<tr><td>
        <input type="hidden" name="act" value="new">
    </td>
    <td><input type="submit" value="Сохранить" class="button"></td></tr>
</table>
</form>
