<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%messages}}`.
 */
class m201120_084912_create_messages_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%messages}}', [
            'id' => $this->primaryKey(),
            'message' => $this->text(),
            'user_id' => $this->integer(),
            'correctness' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
        $this->addForeignKey('FK_user_message', 'messages','user_id', 'user', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%messages}}');
    }
}
