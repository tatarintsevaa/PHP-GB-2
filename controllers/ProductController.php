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
        $catalog = Products::getAll();
        echo $this->render('catalog', ['catalog' => $catalog]);
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