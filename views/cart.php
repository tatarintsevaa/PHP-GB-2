<h1>Корзина</h1>
<div class="order">
    <? if (empty($cart)) : ?>
        <h1>Ваша корзина пуста</h1>
    <? else: ?>
        <table class="order_cart">
            <tr>
                <td></td>
                <td>Наименование</td>
                <td>Кол-во</td>
                <td>Цена</td>
                <td>Удалить</td>
            </tr>
            <? foreach ($cart as $item): ?>
                <tr>
                    <td><img src="http://via.placeholder.com/80x50" alt=""></td>
                    <td><?= $item['name'] ?></td>
                    <td><?= $item['qty'] ?></td>
                    <td><?= $item['price'] ?> руб.</td>
                    <td>
                        <button class="btn-rem" data-id="<?= $item['id'] ?>">x</button>
                    </td>
                </tr>
            <? endforeach; ?>
        </table>
    <? endif; ?>
    <div class="order_details"></div>
</div>
<script>
    addEventListener('DOMContentLoaded', () => {
        let delBtn = document.querySelectorAll('.btn-rem');
        delBtn.forEach((elem) => {
            elem.addEventListener('click', (evt) => {
                evt.preventDefault();
                let id = evt.target.dataset.id;
                fetch(`/cart/del/?id=${id}`)
                    .then((response) => response.json())
                    .then((data) => {
                        updateCartQty(data.qty);
                        const newQty = data.newQty;
                        if (newQty >= 1) {
                            elem.parentElement.previousElementSibling.previousElementSibling.textContent = newQty;
                            // const totalPrice = document.getElementById('total');
                            // totalPrice.innerText = data.totalPrice;
                        } else {
                            elem.parentElement.parentElement.remove();
                            // const totalPrice = document.getElementById('total');
                            // totalPrice.innerText = data.totalPrice;
                        }

                    })
                    .catch((error) => {
                        console.log(error);
                    })
            })
        });
    });

</script>