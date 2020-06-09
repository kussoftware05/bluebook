<?php

namespace admin\models;

use Yii;

/**
 * This is the model class for table "notification".
 *
 * @property int $id
 * @property string $title
 * @property string $notification_body
 * @property int|null $send_notification
 * @property int|null $userId
 *
 */
class Notification extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notification_details';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title','notification_body'], 'string'],
			[['send_notification'], 'safe'],
            [['userId'], 'integer'],
            [['title'], 'string', 'max' => 255],
            
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'send_notification' => 'Send Notification',
			'title' => 'Title',
			'notification_body' => 'Body',
            'userId' => 'User',
        ];
    }
	/*
	* get User details
	* return array
	*/
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }
}
