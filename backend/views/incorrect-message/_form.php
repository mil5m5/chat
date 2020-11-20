<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\IncorrectMessage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="incorrect-message-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'message_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
