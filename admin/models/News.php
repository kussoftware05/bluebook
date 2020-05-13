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
 * @property string|null $news_image
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
            [['content', 'status'], 'string'],
            [['published_at', 'updated_at'], 'safe'],
            [['cat_id'], 'integer'],
            [['title', 'short_desp', 'author', 'news_image'], 'string', 'max' => 255],
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
            'published_at' => 'Published Date',
            'updated_at' => 'Updated Date',
            'status' => 'Status',
            'cat_id' => 'Category',
            'news_image' => 'Image',
        ];
    }

    /**
     * Gets query for [[Cat]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCat()
    {
        return $this->hasOne(Category::className(), ['id' => 'cat_id']);
    }

    /**
     * Gets query for [[Image]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasOne(Image::className(), ['id' => 'image_id']);
    }
}
