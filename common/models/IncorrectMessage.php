<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "incorrect_messages".
 *
 * @property int $id
 * @property int|null $message_id
 *
 * @property Message $message
 */
class IncorrectMessage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'incorrect_messages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['message_id'], 'integer'],
            [['message_id'], 'exist', 'skipOnError' => true, 'targetClass' => Message::class, 'targetAttribute' => ['message_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'message_id' => 'Message',
        ];
    }

    /**
     * Gets query for [[Message]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMessage()
    {
        return $this->hasOne(Message::class, ['id' => 'message_id']);
    }
}
