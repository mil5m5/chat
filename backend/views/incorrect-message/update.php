<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\IncorrectMessage */

$this->title = 'Update Incorrect Message: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Incorrect Messages', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="incorrect-message-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
