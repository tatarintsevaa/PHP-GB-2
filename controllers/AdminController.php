<?php


namespace app\controllers;


use app\engine\App;

class AdminController extends Controller
{
    public function actionIndex() {
        if (App::call()->usersRepository->isAdmin())
        {
            $orders = App::call()->ordersRepository->getAll();
            echo $this->render('admin', ['orders' => $orders]);
        } else {
            echo $this->render('error');
        }
    }

    public function actionEditStatus () {
        $id = (int)App::call()->request->getParams()['id'];
        $status = (int)App::call()->request->getParams()['status'];
        $order = App::call()->ordersRepository->getOne($id);
        $order->status = $status;
        $status_list = App::call()->config['status_list'];
        App::call()->ordersRepository->save($order);
        header('Content-Type: application/json');
        echo json_encode(['status' => $status_list[$order->status]]);
    }



}