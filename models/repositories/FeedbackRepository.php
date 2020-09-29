<?php
namespace app\models\repositories;

use app\engine\App;
use app\models\Repository;
use app\engine\Db;
use app\models\entities\Feedback;

class FeedbackRepository extends Repository
{

    public function getAllFeedback($id)
    {
        $sql = "SELECT * FROM feedback WHERE id_good = :id ORDER BY id DESC";
        return App::call()->db->queryAll($sql, ['id' => $id]);
    }


    public function getTableName()
    {
        return "feedback";
    }

    public function getEntityClass() {
        return Feedback::class;
    }


}