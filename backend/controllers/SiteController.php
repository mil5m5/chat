<?php
namespace backend\controllers;

use common\models\Message;
use common\models\User;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends MainController
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (Yii::$app->user->identity->role == User::ROLE_ADMIN) {
            $model = new Message();
            $messages = Message::find()->orderBy(['created_at' => SORT_ASC])->all();
                $userId = Yii::$app->user->id;
                if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                    $model->checkingTextForValidity();
                    $model->user_id = $userId;
                    $model->save();
                    return $this->redirect(['index']);
                }
            return $this->render('index', compact('model', 'messages'));
        }
        return $this->redirect(['logout']);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
