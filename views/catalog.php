<h1 class="section-name">Каталог</h1>
<div class="products">
    <?php foreach ($catalog as $item): ?>
        <div class="product-item">
            <a href="?c=product&a=card&id=<?=$item['id']?>" target="_blank" title="Подробнее о товаре">
                <img src="http://via.placeholder.com/150x120" alt="<?=$item['name']?>">
            </a>
            <div class="product-item__text">
                <h3><?=$item['name']?></h3>
                <p>Цена: <strong><?=$item['price']?></strong> руб.</p>
                <button class="by-btn">Купить</button>
            </div>
        </div>
    <?php endforeach;?>
</div>