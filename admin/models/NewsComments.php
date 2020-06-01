<?php

namespace admin\models;

use Yii;

/**
 * This is the model class for table "news_comments".
 *
 * @property int $id
 * @property int $newsId
 * @property int $userId
 * @property string $comments
 * @property string|null $postedon
 * @property string $status
 * @property string|null $ip_address
 */
class NewsComments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'news_comments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['newsId', 'userId', 'comments'], 'required'],
            [['newsId', 'userId'], 'integer'],
            [['comments', 'commentedon', 'ip_address', 'published'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'newsId' => 'News ID',
            'userId' => 'User ID',
            'comments' => 'Comments',
			'commentedon' => 'Date of Comment',
			'published' => 'Published'
        ];
    }
	public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }
}
