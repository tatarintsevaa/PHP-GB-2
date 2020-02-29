<?php
/**
 * @var \app\models\Products $product
 */
?>
<div class="card">
    <h3><?=$product->name?></h3>
    <div class="card_box">
        <img src="http://via.placeholder.com/300x200" alt="photo">
        <div class="card_box__text">
            <div>
                <p><strong>Описание товара</strong></p>
                <p><?=$product->description?></p>
            </div>
            <p>Цена <strong><?=$product->price?> руб.</strong></p>
            <button class="by-btn">Купить</button>
        </div>
    </div>
</div>
<hr>
<h3>Оставьте отзыв</h3>
<div id="feedback" ">
    <input type="text" placeholder="Имя" id="name">
    <input type="text" placeholder="Отзыв" id="feed">
    <button id="ok" data-id_good="<?= $product->id?>">Отправить</button>
</div>
<br>
<h3>Отзывы</h3>
<div class="feedback_list">
    <? foreach ($feedback as $value): ?>
        <div>
            <span><strong><?= $value['name'] ?></strong>: <?= $value['feedback'] ?></span>
            <a href="/" class="edit" data-id_feed="<?= $value['id'] ?>">[править]</a>
            <a href="/" class="del" data-id_feed="<?= $value['id'] ?>">[X]</a>
        </div>
    <? endforeach; ?>
</div>

<script>


    document.addEventListener('DOMContentLoaded', () => {
        addEvent(btnOk);
        document.querySelectorAll('.edit').forEach((elem) => {
            editEvent(elem);
        });

        document.querySelectorAll('.del').forEach((elem) => {
            delEvent(elem);

        });

    })


</script>