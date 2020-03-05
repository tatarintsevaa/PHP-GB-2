<h1>Корзина</h1>
<div class="order">
    <table class="order_cart">
        <? foreach ($cart as $item):?>
            <tr>
                <td><img src="http://via.placeholder.com/80x50" alt=""></td>
                <td><?=$item['name']?></td>
                <td><?=$item['qty']?></td>
                <td><?=$item['qty'] * $item['price']?> руб.</td>
                <td><button class="btn-rem">x</button></td>
            </tr>
        <?endforeach;?>
    </table>
    <div class="order_details"></div>
</div>
