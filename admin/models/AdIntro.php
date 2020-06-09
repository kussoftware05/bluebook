<?php

namespace admin\models;

use Yii;

/**
 * This is the model class for table "ad_intro".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $filename
 * @property int|null $filetype
 * @property int|null $displayorder
 *
 */
class AdIntro extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ad_intro';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title','description','filename'], 'string'],
			[['filetype'], 'safe'],
            [['displayorder'], 'integer'],
            [['filename'], 'string', 'max' => 255],
            [['title'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'filename' => 'File Name',
			'title' => 'Title',
			'description' => 'Description',
            'filetype' => 'Intro Type',
            'displyorder' => 'Display Order',
        ];
    }
	
}
