<?php

namespace app\controllers;

use app\models\Products;
use app\models\Feedback;

class ProductController extends Controller
{
    public function actionIndex()
    {
        echo $this->render('index');
    }

    public function actionCatalog()
    {
        $page = (int)$_GET['page'];
        if (is_null($_GET['page'])) {
            $page = 0;
        };

        $action = $_GET['action'];
        if ($action == 'next' && $page <= PAGINATION_ITEM_COUNT) {
            $page = $page + PAGINATION_ITEM_COUNT;
        } elseif ($action == 'prev' && $page >= PAGINATION_ITEM_COUNT) {
            $page = $page - PAGINATION_ITEM_COUNT;
        }
        $pageCount = Products::getPagesCount();

        $catalog = Products::showLimit($page, PAGINATION_ITEM_COUNT);
        $step = 0;
        echo $this->render('catalog', ['catalog' => $catalog, 'page' => $page, 'pageCount' => $pageCount, 'step' => $step]);
    }

    public function actionApiCatalog()
    {
        $catalog = Products::getAll();
        header('Content-Type: application/json');
        echo json_encode($catalog, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function actionCard()
    {
        $id = (int) $_GET['id'];
        $product = Products::getOne($id);
        $feedback = Feedback::getAllFeedback($id);
        echo $this->render('card', ['product' => $product, 'feedback' => $feedback]);
    }

}