<?php


namespace app\controllers;

use app\engine\Request;
use app\models\Cart;


class CartController extends Controller
{
    public function actionIndex()
    {
        $cart = Cart::getCartProducts(session_id());
        echo $this->render('cart', ['cart' => $cart]);
    }

    public function actionBuy()
    {
        $id = (new Request())->getParams()['id'];
        $cartItem = Cart::getOneCartItem($id, session_id());
        if ($cartItem) {
            $cartItem->qty++;
            $cartItem->save();
        } else {
            $cartItem = new Cart($id, session_id());
            $cartItem->save();
        }
        $qty = Cart::getQty(session_id());
        header('Content-Type: application/json');
        echo json_encode(['qty' => $qty]);
    }

    public function actionDel()
    {
        $id = (new Request())->getParams()['id'];
        $cartItem = Cart::getOne($id);
        $session = session_id();
        if ($session == $cartItem->session_id) {
            if ($cartItem->qty > 1) {
                $cartItem->qty--;
                $cartItem->save();
                $newQty = $cartItem->qty;
            } else {
                $cartItem->delete();
                $newQty = 0;
            }
        }
        $qty = Cart::getQty(session_id());
        header('Content-Type: application/json');
        echo json_encode(['qty' => $qty, 'newQty' => $newQty]);
    }


}