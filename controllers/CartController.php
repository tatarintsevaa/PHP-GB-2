<?php


namespace app\controllers;

use app\engine\App;
use app\engine\Request;
use app\models\entities\Cart;
use app\models\entities\Orders;
use app\models\repositories\CartRepository;


class CartController extends Controller
{
    public function actionIndex()
    {
        $cart = App::call()->cartRepository->getCartProducts(session_id());
        $totalPrice = App::call()->cartRepository->totalPrice($cart);
        echo $this->render('cart', ['cart' => $cart, 'total' => $totalPrice]);
    }

    public function actionBuy()
    {

        $id = App::call()->request->getParams()['id'];
        $cartItem = App::call()->cartRepository->getOneCartItem($id, session_id());
        if ($cartItem) {
            $cartItem->qty++;
            App::call()->cartRepository->save($cartItem);
        } else {
            $cartItem = new Cart($id, session_id());
            App::call()->cartRepository->save($cartItem);
        }
        $qty = App::call()->cartRepository->getQty(session_id());
        header('Content-Type: application/json');
        echo json_encode(['qty' => $qty]);
    }

    public function actionDel()
    {
        $id = App::call()->request->getParams()['id'];
        $cartItem = App::call()->cartRepository->getOne($id);
        $session = session_id();
        $newQty = null;
        if ($session == $cartItem->session_id) {
            if ($cartItem->qty > 1) {
                $cartItem->qty--;
                App::call()->cartRepository->save($cartItem);
                $newQty = $cartItem->qty;
            } else {
                App::call()->cartRepository->delete($cartItem);
                $newQty = 0;
            }
        }
        $qty = App::call()->cartRepository->getQty(session_id());
        $cart = App::call()->cartRepository->getCartProducts(session_id());
        $totalPrice = App::call()->cartRepository->totalPrice($cart);
        header('Content-Type: application/json');
        echo json_encode(['qty' => $qty, 'newQty' => $newQty, 'total' => $totalPrice]);
    }

    public function actionCheckout() {
        $name = App::call()->request->getParams()['name'];
        $phone = App::call()->request->getParams()['phoneNum'];
        $cart = App::call()->cartRepository->getCartProducts(session_id());
        $price = App::call()->cartRepository->totalPrice($cart);
        $order = new Orders(session_id(),$name, (int)$phone, $price);
        App::call()->ordersRepository->save($order);
        session_regenerate_id();
        header('Content-Type: application/json');
        echo json_encode([ 'totalPrice' => $order->price, 'id' => $order->id]);
    }
}