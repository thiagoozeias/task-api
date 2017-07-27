<?php

namespace app\modules\api\controllers;

/**
 * Default controller for the `api` module
 */
use app\models\Task;
use yii\data\ActiveDataProvider;

class DefaultController extends \yii\rest\ActiveController {

    public $modelClass = 'app\models\Task';

    public function actions() {
        $actions = parent::actions();
        unset($actions['index']);
        unset($actions['last']);
        return $actions;
    }

    public function actionLast() {
        $query = Task::find()->orderBy('ordem DESC')
                ->one();

        return $query;
    }

    public function actionIndex() {

        $query = Task::find();


        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false,
            'sort' => [
                'defaultOrder' => [
                    'ordem' => SORT_ASC,
                ],
            ],
        ]);

// returns an array of Post objects
        return $provider->getModels();
    }

}
