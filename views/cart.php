<h1 class="section-name">Корзина</h1>
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
        <div class="order_details">
            <div class="order_details__total">
                <p>Сумма заказа</p>
                <p><span id="total"><?= $total ?></span> руб.</p>
            </div>
            <div class="order_details__checkout">
                <input type="text" name="name" placeholder="ФИО" id="name">
                <input type="text" name="phone" placeholder="Номер телефона" id="phone">
                <button class="checkoutBtn ">Оформить заказ</button>
            </div>
        </div>
    <? endif; ?>

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
                        const totalPrice = document.getElementById('total');
                        if (newQty >= 1) {
                            elem.parentElement.previousElementSibling.previousElementSibling.textContent = newQty;
                            totalPrice.innerText = data.total;
                        } else {
                            elem.parentElement.parentElement.remove();
                            totalPrice.innerText = data.total;
                            if (data.qty < 1) {
                                location.reload()
                            }
                        }

                    })
                    .catch((error) => {
                        console.log(error);
                    })
            })
        });

        const checkoutBtn = document.querySelector('.checkoutBtn');
        checkoutBtn.addEventListener('click', () => {
            const name = document.getElementById('name').value;
            const phoneNum = document.getElementById('phone').value;
            const totalPrice = document.getElementById('total').value;
            let elem = document.querySelector('.red');
            if (name === '' || phoneNum === '') {
                if (elem == null) {
                    elem = document.createElement('p');
                    checkoutBtn.insertAdjacentElement('beforebegin', elem);
                    elem.className = 'red';
                    elem.innerText = 'Заполните все поля!'
                }
            } else {
                if (elem) {
                    elem.remove();
                }
                fetch('/cart/checkout', {
                    method: 'POST',
                    body: JSON.stringify({
                        name: name,
                        phoneNum: phoneNum,
                    }),
                    headers: {
                        'Content-type': 'application/json',
                    },
                })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.id !== 0) {
                            elem = document.createElement('p');
                            elem.className = 'red';
                            elem.innerText = `Ваш заказ на сумму ${data.totalPrice} руб. успешно оформлен!`;
                            checkoutBtn.insertAdjacentElement('afterend', elem);
                            checkoutBtn.remove();
                            document.querySelector('.cart_qty').remove();
                        }
                    })
                    .catch((error) => {
                        console.log(error);
                    })
            }
        });
    });

</script>