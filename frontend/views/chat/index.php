<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\User;
?>

<div style="border: 1px solid #00000012;">
<div class="row">
    <div class="col-md-12">
        <div id="msg_history" class="msg_history" style="height: <?= Yii::$app->user->isGuest ? '500px!important' : ''?>">
            <?php foreach($messages as $message): ?>
                <?php if ($message->user_id !== Yii::$app->user->id && $message->user->role !== User::ROLE_ADMIN): ?>
                    <div class="incoming_msg">
                        <div class="incoming_msg_img"> <div class="username"><?= $message->user->username?></div></div>
                            <div class="received_msg">
                                <div class="received_withd_msg">
                                    <?php if ($message->correctness == true) : ?>
                                        <p>The message is not correct</p>
                                    <?php else:?>
                                        <p><?= $message->message?></p>
                                    <?php endif?>
                                    <span class="time_date"><?= $message->getTime()?></span>
                                </div>
                            </div>
                    </div>
                <?php elseif ($message->user->role == User::ROLE_ADMIN): ?>
                    <div class="incoming_msg">
                        <div class="incoming_msg_img_admin"><div class="username"><?= $message->user->username?></div></div>
                            <div class="received_msg">
                                <div class="received_withd_msg">
                                    <p><?= $message->message?></p>
                                    <span class="time_date"><?= $message->getTime()?></span></div>
                            </div>
                    </div>
                <?php else:?>
                    <div class="outgoing_msg">
                        <div class="sent_msg">
                            <?php if ($message->correctness == true) : ?>
                                <p>The message is not correct</p>
                            <?php else:?>
                                <p><?= $message->message?></p>
                            <?php endif?>
                            <span class="time_date"><?= $message->getTime()?></span>
                        </div>
                    </div>
                <?php endif?>
            <?php endforeach; ?>
        </div>
    </div>
</div>
</div>
<?php if (!Yii::$app->user->isGuest) :?>
    <div class="row" style="padding: 13px;">
        <div class="col">
            <?php $form = ActiveForm::begin();?>
            <div class="col">
    <!--            <div class="input_msg_write">-->
                    <?= $form->field($model, 'message')->textarea() ?>
    <!--            </div>-->
            </div>
            <div class="col">
                <button class="btn btn-primary">Send</button>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
<?php endif?>