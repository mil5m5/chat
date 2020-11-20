<?php

namespace backend\controllers;

use common\models\IncorrectMessage;
use common\models\User;
use Yii;
use common\models\Message;
use common\models\MessageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MessageController implements the CRUD actions for Message model.
 */
class MessageController extends MainController
{
    public function beforeAction($action)
    {
        if (isset(Yii::$app->user->identity) && Yii::$app->user->identity->role == User::ROLE_ADMIN) {
            return parent::beforeAction($action);
        }
        throw new NotFoundHttpException('You don\'t have access to this page.');
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Message models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MessageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Message model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Message model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Message();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Message model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($correctness = Yii::$app->request->post('correctness')) {
            $model->correctness = $correctness == 'on' ? 1 : 0;
            if($model->save(false)) {
                 if (!(IncorrectMessage::find()->where(['message_id' => $model->id])->one()) && $correctness == 'on') {
                        $incorrectMessage = new IncorrectMessage();
                        $incorrectMessage->message_id = $model->id;
                        $incorrectMessage->save();
                 }
                if ((IncorrectMessage::find()->where(['message_id' => $model->id])->one()) && $correctness == 'off') {
                    IncorrectMessage::deleteAll(['message_id' => $model->id]);
                }
            }
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if (($model->correctness == false) && (IncorrectMessage::find()->where(['message_id' => $model->id])->one())) {
                IncorrectMessage::deleteAll(['message_id' => $model->id]);
            }elseif(($model->correctness == true) && !(IncorrectMessage::find()->where(['message_id' => $model->id])->one())){
                $incorrectMessage = new IncorrectMessage();
                $incorrectMessage->message_id = $model->id;
                $incorrectMessage->save();
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Message model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Message model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Message the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Message::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
