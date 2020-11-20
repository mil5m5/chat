<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\IncorrectMessage */

$this->title = 'Create Incorrect Message';
$this->params['breadcrumbs'][] = ['label' => 'Incorrect Messages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="incorrect-message-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
