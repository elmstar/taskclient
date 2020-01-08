<form act="/users/edit" method="POST">
<table>
<tr><td>ФИО</td><td><input name="FIO" class="string" value="<?php echo $result['FIO'] ?>"></td></tr>
<tr><td><input type="hidden" name="id" value="<?php echo $result['id'] ?>"><input type="hidden" name="act" value="edit"></td>

<td><input type="submit" value="Сохранить"></td></tr>
</table>
</form>
