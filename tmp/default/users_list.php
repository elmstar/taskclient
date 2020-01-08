<table class="content">
    <thead>
    <th>№</th><th>ФИО</th><th>Действия</th>
    </thead>
    <?php
    if (!empty($result) AND count($result)>0 AND is_array($result)) {
        foreach ($result AS $item) {
            ?>
            <tr>
                <td><?= $item['id'] ?></td><td><?= $item['FIO'] ?></td>
                <td>
                    <a href="<?php echo $routeAction.'edit/'.$item['id'] ?>">Правка</a>
                    <a href="<?php echo $routeAction.'delete/'.$item['id'] ?>">Удалить</a>
                </td>
            </tr>
            <?php
        }
    } else {
    ?>
        <td colspan="7">Пользователи отсутствуют</td>
<?php }	?>
<tr>
<td><a href="<?php echo $routeAction ?>new">Добавить</a></td>
</tr>
</table>
