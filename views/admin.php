<h1 class="section-name">Админка</h1>
<table class="admin-orders">
    <tr>
        <td>ID</td>
        <td>Имя клиента</td>
        <td>Телефон</td>
        <td>текущий статус</td>
        <td>новый статус</td>
        <td>Изменить статус</td>
    </tr>
    <?php foreach ($orders as $item): ?>
        <tr>
            <td><?= $item['id'] ?></td>
            <td><?= $item['user'] ?></td>
            <td><?= $item['name'] ?></td>
            <td><?= $item['phone'] ?></td>
            <? if ((int)$item['status'] == 1): ?>
                <td id="current-status">Создан</td>
            <? elseif ((int)$item['status'] == 2): ?>
                <td id="current-status">Оплачен</td>
            <? else: ?>
                <td id="current-status">Отправлен</td>
            <? endif; ?>
            <td>
                <select id="status">
                    <option value="1" selected>Создан</option>
                    <option value="2">Оплачен</option>
                    <option value="3">Отправлен</option>
                </select>
            </td>
            <td>
                <button class="edit-status" data-id="<?= $item['id'] ?>">Изменить статус</button>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.edit-status').forEach((elem) => {
            elem.addEventListener('click', (evt) => {
                let id = evt.target.dataset.id;
                let status = elem.parentElement.parentElement.querySelector('#status').value;
                fetch(`/admin/editStatus/?id=${id}&status=${status}`)
                    .then((response) => response.json())
                    .then((data) => {
                        if (data !== null) {
                            elem.parentElement.parentElement.querySelector('#current-status').innerHTML = data.status;
                        }
                    })

            })
        })
    })

</script>