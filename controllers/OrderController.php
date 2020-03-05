<?php


namespace app\controllers;

use app\models\Cart;


class OrderController extends Controller
{
    public function actionIndex()
    {
        echo $this->render('index');
    }

    public function actionCart()
    {
        $cart = Cart::getCartProducts(session_id());
        echo $this->render('order', ['cart' => $cart]);
    }



}