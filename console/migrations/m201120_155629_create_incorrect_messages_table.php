<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%incorrect_messages}}`.
 */
class m201120_155629_create_incorrect_messages_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%incorrect_messages}}', [
            'id' => $this->primaryKey(),
            'message_id' => $this->integer(),
        ]);
        $this->addForeignKey('FK_incorrect_messages_message', 'incorrect_messages', 'message_id', 'messages', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%incorrect_messages}}');
    }
}
