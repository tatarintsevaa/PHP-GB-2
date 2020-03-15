<h1 class="section-name">Каталог</h1>
<div class="products">
    <?php foreach ($catalog as $item): ?>
        <div class="product-item">
            <a href="/product/card/?id=<?= $item['id'] ?>" target="_blank" title="Подробнее о товаре">
                <img src="http://via.placeholder.com/150x120" alt="<?= $item['name'] ?>">
            </a>
            <div class="product-item__text">
                <h3><?= $item['name'] ?></h3>
                <p>Цена: <strong><?= $item['price'] ?></strong> руб.</p>
                <button class="by-btn" data-id="<?= $item['id'] ?>">Купить</button>
            </div>
        </div>
    <?php endforeach; ?>

</div>
<div class="pagination" class="pagination">
    <? if ($prev >= 1): ?>
        <a class="pagination_item" href="/product/catalog/?page=<?= $prev ?>"><</a>
    <? endif; ?>
    <?php for ($i = 1; $i <= $pageCount; $i++): ?>
        <? if ($page == $i): ?>
            <span class="pagination_item" id="active"><?= $i ?></span>
        <? else: ?>
            <a class="pagination_item" href="/product/catalog/?page=<?= $i ?>"><?= $i ?></a>
        <? endif; ?>
    <? endfor; ?>
    <? if ($next <= $pageCount): ?>
    <a class="pagination_item" href="/product/catalog/?page=<?= $next ?>">></a>
    <? endif; ?>
</div>
<script>

    addEventListener('DOMContentLoaded', () => {
        const byBtn = document.querySelectorAll('.by-btn');
        byBtn.forEach((elem) => {
            elem.addEventListener('click', (evt) => {
                evt.preventDefault();
                let id = evt.target.dataset.id;
                fetch(`/cart/buy/?id=${id}`)
                    .then((response) => response.json())

                    .then((data) => {
                        if (data.qty === 1) {
                            creatCartQty(data.qty);

                        } else {
                            updateCartQty(data.qty);

                        }
                    })
                    .catch((error) => {
                        console.log(error);
                    })
            })
        })
    })

</script>

