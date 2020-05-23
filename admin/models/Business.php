<?php

namespace admin\models;

use Yii;
use admin\models\interfaces\ImageInterface;
//use admin\models\BlogCategory;
//use admin\models\Image;

/**
 * This is the model class for table "blog".
 *
 * @property int $id
 * @property string $business_name
 * @property string|null $description
 * @property string|null $bannerimg
 * @property string|null $email
 * @property string|null $contactno
 * @property string|null $city
 * @property string|null $otherinfo
 * @property int|null $countryId
 * @property int|null $stateId
 *
 * @property BlogCategory $cat
 */
class BusinessDirectory extends \yii\db\ActiveRecord implements ImageInterface
{
    /**
     * @var $TYPE
     */
    //public const TYPE = 'BLOG';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'business_directory';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['business_name'], 'required'],
            [['description', 'bannerimg','email','contactno','otherinfo'], 'string'],
            //[['published_at', 'updated_at'], 'safe'],
            [['countryId', 'stateId'], 'integer'],
            //[['business_name', 'short_desp', 'author'], 'string', 'max' => 255],
            [['business_name'], 'unique'],
            //[['cat_id'], 'exist', 'skipOnError' => true, 'targetClass' => BlogCategory::className(), 'targetAttribute' => ['cat_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'business_name' => 'Business Name',
            'description' => 'Description',
            'banner_img' => 'Banner Image',
            'email' => 'Email',
            'contactno' => 'Contact Number',
            'countryId' => 'Country',
            'stateId' => 'State',
            'city' => 'City',
            'otherinfo' => 'Other Info',
        ];
    }

    /**
     * Gets query for [[Cat]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCat()
    {
        return $this->hasOne(BlogCategory::className(), ['id' => 'cat_id']);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) 
        {
            if (!$this->isNewRecord)
                $this->updated_at = date("Y-m-d H:i:s"); 
            return true;
        }
        return false;
    }

    /**
     * create a new business directory
     * @param array $data
     * @param array $image
     * @return bool
     */
    public function createNewDirectory($data=[], $file=[])
    {
        if(empty($data)) 
            return;
        if($this->load($data)) 
        {
            $this->insert();
           /* if($file['name'] != '') 
            {
                $image = new Image;
                $image_upload_id = $image->createOrUploadAnImage(null,self::TYPE, $file,self::uploadImagePath());
                if($image_upload_id !== false) 
                {
                    $current_model = self::findOne($this->id);
                    $current_model->image_id = (int)$image_upload_id;
                    return $current_model->save();
                }
            }*/
            return true;
        }
        return false;
    }

    /**
     * update a blog
     * @param int $id
     * @param array $data
     * @param array $file
     * @return bool
     */
    public function updateBlog($id, $data, $file) 
    {
        $blog = self::findOne($id);
        if($blog->load($data)) 
            $blog->save();
        if(isset($file['name']) && !empty($file['name'])) 
        {
            $image = new Image;
            $image->createOrUploadAnImage($blog->image_id, self::TYPE, $file,self::uploadImagePath());
        }
        return true;
    }

    public static function deleteBlog($id) 
    {
        if(empty($id)) 
            return false;
        $blog = self::findOne($id);
        if($blog)
        {
            Image::deleteAnImage($blog->image_id,self::uploadImagePath());
            $blog->delete();
            return true;
        } 
        else 
            return false;

    }

    /**
     * get blog image
     * @param int $id
     * @return string 
     */
    public static function getBlogImage($id) 
    {
        $blog = self::findOne($id);
        if(is_null($blog)) 
            return '';
        return Image::getImageNameById($blog->image_id);
    }

    /**
     * return image full path 
     * @param int $id
     * @return string
     */
    public static function getBlogImageWithPath($id) 
    {
        $image = self::getBlogImage($id);
        return  '/uploads/' . strtolower(self::TYPE) . '/' . $image;
    }

    /**
     * return blog image path
     * @return string
     */
    public static function uploadImagePath()
    {
        return Yii::getAlias('@webroot') . '/uploads/' . strtolower(self::TYPE);
    }
}
