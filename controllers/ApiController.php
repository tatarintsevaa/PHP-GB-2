<?php


namespace app\controllers;


use app\engine\App;
use app\models\entities\Feedback;

class ApiController extends Controller
{


    public function actionAdd() {
        $data = App::call()->request->getParams();
        $feedback = new Feedback($data['name'], $data['feed'], $data['id_good']);
        App::call()->feedbackRepository->save($feedback);
        header('Content-Type: application/json');
        echo json_encode(['id' => $feedback->id]);
    }

    public function actionEdit() {
        if (App::call()->usersRepository->isAdmin()) {
            $id_feed = App::call()->request->getParams()['id_feed'];
            $feedback = App::call()->feedbackRepository->getOne($id_feed);
            header('Content-Type: application/json');
            echo json_encode(['name' => $feedback->name, 'feed' => $feedback->feedback]);
        }

    }

    public function actionSave() {
        if (App::call()->usersRepository->isAdmin()) {
            $id_feed = App::call()->request->getParams()['id_feed'];
            $data = App::call()->request->getParams();
            $feedback = App::call()->feedbackRepository->getOne($id_feed);
            $feedback->name = $data['name'];
            $feedback->feedback = $data['feed'];
            $result = App::call()->feedbackRepository->save($feedback);
            header('Content-Type: application/json');
            echo json_encode(['status' => $result]);
        }

    }

    public function actionDelete() {
        if (App::call()->usersRepository->isAdmin()) {
            $id_feed = App::call()->request->getParams()['id_feed'];
            $feedback = App::call()->feedbackRepository->getOne($id_feed);
            $result = App::call()->feedbackRepository->delete($feedback);
            header('Content-Type: application/json');
            echo json_encode(['status' => $result]);
        }
    }

    public function actionCartQty() {
        $qty = App::call()->cartRepository->getQty(session_id());
        header('Content-Type: application/json');
        echo json_encode(['qty' => $qty]);
    }
}