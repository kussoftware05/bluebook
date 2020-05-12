<?php

namespace admin\models;

use Yii;

/**
 * This is the model class for table "settings".
 *
 * @property integer $settings_id
 * @property string $facebook_add
 * @property string $google_add
 * @property string $twitter
 * @property string $admin_email
 * @property string $copyright
 * @property string $contact_address
 * @property string $contact_phone
 * @property string $contact_email
 */
class Settings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'settings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['admin_email'], 'required'],
			[['contact_email', 'contact_phone', 'contact_address'], 'safe'],
            [['admin_email','facebook_add','google_add','twitter','copyright'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'settings_id' => 'Settings ID',
			'facebook' => 'Facebook Adds',
			'google_add'=> 'Google Adds',
			'twitter' =>'twitter url',
			'copyright' =>'Copyright'
			
        ];
    }
}
