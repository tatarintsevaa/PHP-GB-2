<?php
namespace app\models\repositories;

use app\models\Repository;
use app\engine\Db;
use app\models\entities\Feedback;

class FeedbackRepository extends Repository
{

    public function getAllFeedback($id)
    {
        $sql = "SELECT * FROM feedback WHERE id_good = :id ORDER BY id DESC";
        return DB::getInstance()->queryAll($sql, ['id' => $id]);
    }


    public function getTableName()
    {
        return "feedback";
    }

    public function getEntityClass() {
        return Feedback::class;
    }


}