<h1>Корзина</h1>
<div class="order">
    <table class="order_cart">
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
                            elem.previousElementSibling.textContent = newQty;
                            const totalPrice = document.getElementById('total');
                            totalPrice.innerText = data.totalPrice;
                        } else {
                            elem.parentElement.nextElementSibling.remove();
                            elem.parentElement.remove();
                            const totalPrice = document.getElementById('total');
                            totalPrice.innerText = data.totalPrice;
                        }

                    })
                    .catch((error) => {
                        console.log(error);
                    })
            })
        });
    });

</script>