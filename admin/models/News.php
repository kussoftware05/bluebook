<?php

namespace admin\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property int $id
 * @property string $title
 * @property string|null $content
 * @property string|null $short_desp
 * @property string|null $author
 * @property string|null $published_at
 * @property string|null $updated_at
 * @property string|null $status
 * @property int|null $cat_id
 * @property int|null $userId
 * @property string|null $news_image
 * @property string|null $mediatype
 * @property string|null $newstype
 * @property int $totallike
 * @property int $totaldislike
 * @property string|null $address
 * @property string|null $city
 * @property int|null $countryId
 * @property int|null $stateId
 *
 * @property Category $cat
 * @property Image $image
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['content', 'status', 'address', 'city'], 'string'],
            [['published_at', 'updated_at'], 'safe'],
            [['cat_id','userId', 'totallike', 'totaldislike', 'stateId', 'countryId'], 'integer'],
            [['title', 'short_desp', 'author', 'news_image', 'mediatype', 'newstype'], 'string', 'max' => 255],
            [['title'], 'unique'],
            [['cat_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['cat_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'content' => 'Content',
            'short_desp' => 'Short Description',
            'author' => 'Author',
			'userId' => 'User',
            'published_at' => 'Published Date',
            'updated_at' => 'Updated Date',
            'status' => 'Status',
            'cat_id' => 'Category',
            'news_image' => 'Image',
			'mediatype' => 'Media Type',
			'newstype' => 'News Type',
			'totallike' => 'Total Like',
			'totaldislike' => 'Total Dislike',	
            'countryId' => 'Country',
			'address' => 'Address',
            'stateId' => 'State',
            'city' => 'City',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }
}
