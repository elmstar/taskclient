<table class="content">
    <thead>
    <th>№</th><th>Заголовок</th><th>Статус</th><th>Создана</th><th>Сделать до</th><th>Исполнитель</th><th>Действия</th>
    </thead>
    <?php
    if (!empty($result) AND count($result)>0 AND is_array($result)) {
        foreach ($result AS $item) {
            ?>
        <tr>
            <td><?php echo $item['id'] ?></td>
            <td><?php echo $item['subj'] ?></td>
            <td><?php echo $item['status'] ?></td>
            <td><?php echo $item['created'] ?></td>
            <td><?php echo $item['deadline'] ?></td>
            <td><?php echo $item['executor'] ?></td>
            <td>
                <a href="<?php echo $routeAction.'edit/'.$item['id'] ?>">Edit</a>
                <a href="<?php echo $routeAction.'delete/'.$item['id'] ?>">Del</a>
            </td>
        </tr>
        <?PHP
        }
    } else {
    ?>
        <td colspan="7">Задачи отсутствуют</td>
<?php }	?>
<tr>
<td><a href="<?php echo $routeAction ?>new">Добавить</a></td>
</tr>
</table>
