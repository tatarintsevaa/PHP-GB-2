<?php


namespace app\controllers;


use app\models\Feedback;
use app\models\Cart;

class ApiController extends Controller
{
    private function getDataPost() {
        $data = json_decode(file_get_contents('php://input'));
        $parsedData = [
            'name' => $data->name,
            'feed' => $data->feed,
            'id_good' => $data->id_good,
        ];
        return $parsedData;
    }

    public function actionAdd() {
        $data = $this->getDataPost();
        $feedback = new Feedback($data['name'], $data['feed'], $data['id_good']);
        $feedback->save();
        echo json_encode(['id' => $feedback->id]);
    }

    public function actionEdit() {
        $id_feed = (int) $_GET['id_feed'];
        $feedback = Feedback::getOne($id_feed);
        echo json_encode(['name' => $feedback->name, 'feed' => $feedback->feedback]);
    }

    public function actionSave() {
        /**
         * @var Feedback $feedback
         */
        $id_feed = (int) $_GET['id_feed'];
        $data = $this->getDataPost();
        $feedback = Feedback::getOne($id_feed);
        $feedback->name = $data['name'];
        $feedback->feedback = $data['feed'];
        $result = $feedback->save();
        echo json_encode(['status' => $result]);
    }

    public function actionDelete() {
        /**
         * @var Feedback $feedback
         */
        $id_feed = (int)$_GET['id_feed'];
        $feedback = Feedback::getOne($id_feed);
        $result = $feedback->delete();
        echo json_encode(['status' => $result]);
    }

    public function actionCartQty() {
        $qty = Cart::getQty(session_id());
        echo json_encode(['qty' => $qty]);
    }
}