<?php


namespace app\controllers;

use app\engine\App;
use app\engine\Request;
use app\models\entities\Cart;
use app\models\repositories\CartRepository;


class CartController extends Controller
{
    public function actionIndex()
    {
        $cart = App::call()->cartRepository->getCartProducts(session_id());
        echo $this->render('cart', ['cart' => $cart]);
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
        header('Content-Type: application/json');
        echo json_encode(['qty' => $qty, 'newQty' => $newQty]);
    }


}