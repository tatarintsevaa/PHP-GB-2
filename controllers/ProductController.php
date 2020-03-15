<?php

namespace app\controllers;

use app\engine\Request;
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
        $page = (new Request())->getParams()['page'];
        if (is_null($_GET['page'])) {
            $page = 1;
        };

        $action = (new Request())->getParams()['action'];
        if ($action == 'next') {
            $page++;
        } elseif ($action == 'prev') {
            $page--;
        }
        $pageCount = Products::getPagesCount();

        $catalog = Products::showLimit((($page - 1) * PAGINATION_ITEM_COUNT), PAGINATION_ITEM_COUNT);
        echo $this->render('catalog', ['catalog' => $catalog,
                                                'page' => $page,
                                                'next' => $page + 1,
                                                'prev' => $page - 1,
                                                'pageCount' => $pageCount]);
    }

    public function actionApiCatalog()
    {
        $catalog = Products::getAll();
        header('Content-Type: application/json');
        echo json_encode($catalog, JSON_UNESCAPED_UNICODE);
    }

    public function actionCard()
    {
        $id = (new Request())->getParams()['id'];
        $product = Products::getOne($id);
        $feedback = Feedback::getAllFeedback($id);
        echo $this->render('card', ['product' => $product, 'feedback' => $feedback]);
    }

}