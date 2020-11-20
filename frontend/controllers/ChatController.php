<?php


namespace frontend\controllers;


use common\models\Message;
use common\models\User;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ChatController extends Controller
{
    public function actionIndex()
    {
        $model = new Message();
        $messages = Message::find()->orderBy(['created_at' => SORT_ASC])->all();
        if (!Yii::$app->user->isGuest && (Yii::$app->user->identity->role == User::ROLE_USER)) {
            $userId = Yii::$app->user->id;
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                $model->checkingTextForValidity();
                $model->user_id = $userId;
                $model->save();
                return $this->redirect(['index']);
            }
        }
        return $this->render('index', compact('messages', 'model'));
    }
}