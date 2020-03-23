<h1 class="section-name">Изменение каталога</h1>
<table class="admin-orders">
    <tr>
        <td>ID</td>
        <td>Наименование</td>
        <td>Описание</td>
        <td>Цена</td>
        <td>Изменить статус</td>
    </tr>
    <?php foreach ($products as $item): ?>
        <tr>
            <td><?= $item['id'] ?></td>
            <td><?= $item['name'] ?></td>
            <td><?= $item['description'] ?></td>
            <td><?= $item['price'] ?></td>
            <td>
                <button class="btn-rem" data-id="<?= $item['id'] ?>">x</button>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<h2>Добавление нового товара</h2>
<form class="addProduct" action="/adminCatalog/addProduct" method="post" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="Введите наименование">
    <input type="text" name="description" placeholder="Введите описание">
    <input type="text" name="price" placeholder="Введите цену">
    Загрузить изображение<input type="file" name="newFile">
    <input type="submit" value="Добавить товар">
</form>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.btn-rem').forEach((elem) => {
            elem.addEventListener('click', (evt) => {
                let id = evt.target.dataset.id;
                console.log(id);
                (
                    async () => {
                        const response = await fetch(`/adminCatalog/delProduct/?id=${id}`);
                        const answer = await response.json();
                        if (answer.result) {
                            elem.parentElement.parentElement.remove();
                        }
                    }
                )();
            })
        })
    });

</script>
