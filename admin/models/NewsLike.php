<?php

namespace admin\models;

use Yii;

/**
 * This is the model class for table "news_like".
 *
 * @property int $id
 * @property int $newsId
 * @property int $userId
 * @property string $ip_address
 * @property string $like
 * @property string $like_date
 */
class NewsLike extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'news_like';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['newsId', 'userId', 'ip_address', 'like_date'], 'required'],
            [['newsId', 'userId'], 'integer'],
            [['like'], 'string'],
            [['like_date'], 'safe'],
            [['ip_address'], 'string', 'max' => 100],
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
            'ip_address' => 'Ip Address',
            'like' => 'Like',
            'like_date' => 'Like Date',
        ];
    }
}
