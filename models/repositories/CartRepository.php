<?php

namespace app\models\repositories;

use app\engine\App;
use app\models\Repository;
use app\models\entities\Cart;

class CartRepository extends Repository
{
    public function getQty($session_id)
    {
        $sql = "SELECT cart.qty FROM cart WHERE session_id = :session_id";
        $result = App::call()->db->queryAll($sql, ['session_id' => $session_id]);
        return array_sum(array_column($result, 'qty'));
    }

    public function getOneCartItem($id_good, $session_id)
    {
        $sql = "SELECT * FROM cart WHERE id_good = :id_good AND session_id = :session_id";
        return App::call()->db->queryObj($sql, ['id_good' => $id_good, 'session_id' => $session_id], $this->getEntityClass());
    }

    public function getCartProducts($session_id)
    {
        $sql = "SELECT products.id as id_good, products.name as name, products.image as image, products.price as price,
 cart.qty as qty, cart.session_id as session_id, cart.id as id FROM products, cart WHERE cart.id_good = products.id AND cart.session_id = :session_id";
        return App::call()->db->queryAll($sql, ['session_id' => $session_id]);
    }

    public function totalPrice($cartItemsList)
    {
        $total = 0;
        foreach ($cartItemsList as $value) {
            $total += (int)$value['qty'] * (int)$value['price'];
        }
        return $total;
    }

    public function getTableName()
    {
        return "cart";
    }

    public function getEntityClass() {
        return Cart::class;
    }
}