<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\MessageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Messages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="message-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Message', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'message:ntext',
            [
                'attribute' => 'user_id',
                'value' => function($searchModel){
                    return $searchModel->user->username;
                }
            ],
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:d.m.Y']
            ],
            [
                'attribute' => 'correctness',
                'format' => 'raw',
                'value' => function ($searchModel) {
                    $input = '<input type="checkbox"';
                    if ($searchModel->correctness == 1) {
                        $input .= ' checked  value="off"';
                    } else {
                        $input .= ' value="on"';
                    }
                    $input .= ' class="correctness-checkbox" data-id="' . $searchModel->id . '">';
                    return $input;
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
