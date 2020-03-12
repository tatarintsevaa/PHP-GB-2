<?php


namespace app\controllers;


use app\engine\Request;
use app\models\Feedback;
use app\models\Cart;

class ApiController extends Controller
{
//    private function getDataPost() {
//        $data = json_decode(file_get_contents('php://input'));
//        $parsedData = [
//            'name' => $data->name,
//            'feed' => $data->feed,
//            'id_good' => $data->id_good,
//        ];
//        return $parsedData;
//    }

    public function actionAdd() {
//        $data = $this->getDataPost();
        $data = (new Request())->getParams();
        $feedback = new Feedback($data['name'], $data['feed'], $data['id_good']);
        $feedback->save();
        header('Content-Type: application/json');
        echo json_encode(['id' => $feedback->id]);
    }

    public function actionEdit() {
        $id_feed = (new Request())->getParams()['id_feed'];
        $feedback = Feedback::getOne($id_feed);
        header('Content-Type: application/json');
        echo json_encode(['name' => $feedback->name, 'feed' => $feedback->feedback]);
    }

    public function actionSave() {
        /**
         * @var Feedback $feedback
         */
        $id_feed = (new Request())->getParams()['id_feed'];
        $data = (new Request())->getParams();
        $feedback = Feedback::getOne($id_feed);
        $feedback->name = $data['name'];
        $feedback->feedback = $data['feed'];
        $result = $feedback->save();
        header('Content-Type: application/json');
        echo json_encode(['status' => $result]);
    }

    public function actionDelete() {
        /**
         * @var Feedback $feedback
         */
        $id_feed = (new Request())->getParams()['id_feed'];
        $feedback = Feedback::getOne($id_feed);
        $result = $feedback->delete();
        header('Content-Type: application/json');
        echo json_encode(['status' => $result]);
    }

    public function actionCartQty() {
        $qty = Cart::getQty(session_id());
        header('Content-Type: application/json');
        echo json_encode(['qty' => $qty]);
    }
}