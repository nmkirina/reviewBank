<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "post.post".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $theme_id
 * @property integer $object_id
 * @property string $title
 * @property string $body
 * @property string $created_on
 * @property boolean $is_public
 * @property string $updated_on
 * @property boolean $moderate
 *
 * @property ObjectObject $object
 * @property PostTheme $theme
 * @property UserUser $user
 * @property PostPostPhoto[] $postPostPhotos
 * @property PostPostVideo[] $postPostVideos
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post.post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'theme_id', 'object_id'], 'integer'],
            [['body'], 'string'],
            [['created_on', 'updated_on'], 'safe'],
            [['is_public', 'moderate'], 'boolean'],
            [['title'], 'string', 'max' => 355],
            [['object_id'], 'exist', 'skipOnError' => true, 'targetClass' => ObjectObject::className(), 'targetAttribute' => ['object_id' => 'id']],
            [['theme_id'], 'exist', 'skipOnError' => true, 'targetClass' => PostTheme::className(), 'targetAttribute' => ['theme_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserUser::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'theme_id' => 'Theme ID',
            'object_id' => 'Object ID',
            'title' => 'Title',
            'body' => 'Body',
            'created_on' => 'Created On',
            'is_public' => 'Is Public',
            'updated_on' => 'Updated On',
            'moderate' => 'Moderate',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObject()
    {
        return $this->hasOne(ObjectObject::className(), ['id' => 'object_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTheme()
    {
        return $this->hasOne(PostTheme::className(), ['id' => 'theme_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(UserUser::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostPostPhotos()
    {
        return $this->hasMany(PostPostPhoto::className(), ['post_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostPostVideos()
    {
        return $this->hasMany(PostPostVideo::className(), ['post_id' => 'id']);
    }
}
