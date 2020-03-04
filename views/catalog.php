<h1 class="section-name">Каталог</h1>
<div class="products">
    <?php foreach ($catalog as $item): ?>
        <div class="product-item">
            <a href="/product/card/?id=<?=$item['id']?>" target="_blank" title="Подробнее о товаре">
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
<div class="pagination" class="pagination">
    <a href="/product/catalog/?page=<?=$page?>&action=prev"><</a>
    <a href="/product/catalog/?page=0">1</a>
    <a href="/product/catalog/?page=2">2</a>
    <a href="/product/catalog/?page=4">3</a>
    <a href="/product/catalog/?page=<?=$page?>&action=next">></a>
</div>

