<?php

namespace app\controllers;

use app\engine\App;
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
        $page = (int)App::call()->request->getParams()['page'];
        if (is_null($_GET['page'])) {
            $page = 1;
        };

        $action = App::call()->request->getParams()['action'];
        if ($action == 'next') {
            $page++;
        } elseif ($action == 'prev') {
            $page--;
        }
        $pageCount = App::call()->productRepository->getPagesCount();

        $qtyDisplayedItems = App::call()->config['qty_displayed_items'];

        $catalog = App::call()->productRepository->showLimit((($page - 1) * $qtyDisplayedItems), $qtyDisplayedItems);
        echo $this->render('catalog', ['catalog' => $catalog,
                                                'page' => $page,
                                                'next' => $page + 1,
                                                'prev' => $page - 1,
                                                'pageCount' => $pageCount]);
    }

    public function actionApiCatalog()
    {
        $catalog = App::call()->productRepository->getAll();
        header('Content-Type: application/json');
        echo json_encode($catalog, JSON_UNESCAPED_UNICODE);
    }

    public function actionCard()
    {
        $id = App::call()->request->getParams()['id'];
        $product = App::call()->productRepository->getOne($id);
        if (($product)) {
            $feedback = App::call()->feedbackRepository->getAllFeedback($id);
            echo $this->render('card', ['product' => $product, 'feedback' => $feedback]);
        } else {
            echo $this->render('error');
        }
    }

}