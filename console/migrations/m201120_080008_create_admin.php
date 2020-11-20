<?php

use common\models\User;
use yii\db\Migration;

/**
 * Class m201120_080008_create_admin
 */
class m201120_080008_create_admin extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $user = new User();
        $user->username = 'admin123';
        $user->email = 'admin123@gmail.com';
        $user->status = User::STATUS_ACTIVE;
        $user->role = User::ROLE_ADMIN;
        $user->setPassword('admin321');
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        return $user->save();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m201120_080008_create_admin cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201120_080008_create_admin cannot be reverted.\n";

        return false;
    }
    */
}
