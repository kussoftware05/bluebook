<?php

namespace admin\models;

use Yii;

/**
 * This is the model class for table "view_details".
 *
 * @property int $id
 * @property int $newsId
 * @property int $userId
 * @property string $ip_address
 * @property string $view_date
 */
class ViewDetails extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'view_details';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['newsId', 'userId', 'ip_address', 'view_date'], 'required'],
            [['newsId', 'userId'], 'integer'],
            [['view_date'], 'safe'],
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
            'view_date' => 'View Date',
        ];
    }
}
