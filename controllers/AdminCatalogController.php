<?php


namespace app\controllers;

use app\engine\App;
use app\models\entities\Products;

class AdminCatalogController extends Controller
{
    public function actionIndex() {
        if (App::call()->usersRepository->isAdmin())
        {
            $products = App::call()->productRepository->getAll();
            echo $this->render('adminCatalog', ['products' => $products]);
        } else {
            echo $this->render('error');
        }
    }

    public function actionAddProduct () {
        /**
         * @var Products $product
         */
        if (App::call()->usersRepository->isAdmin())
        {
            $data = App::call()->request->getParams();
            $filename = '';
            if ($_FILES['newFile']['error'] == 0) {
                $filename = App::call()->simpleImage->filesUpload();
                $data['image'] = $filename;
            }
            $reflection = new \ReflectionClass(Products::class);
            $product = $reflection->newInstanceArgs($data);
            App::call()->productRepository->save($product);
            header('Location: /adminCatalog');
        } else {
            echo $this->render('error');
        }

    }

    public function actionDelProduct() {
        if (App::call()->usersRepository->isAdmin())
        {
            $id = App::call()->request->getParams()['id'];
            $product = App::call()->productRepository->getOne($id);
            if (!is_null($product->image)) {
                App::call()->simpleImage->deleteImage($product->image);
            }
            $result = App::call()->productRepository->delete($product);
            header('Content-Type: application/json');
            echo json_encode(['result' => $result]);
        } else {
            echo $this->render('error');
        }

    }
}