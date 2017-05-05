<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "post.post_video".
 *
 * @property integer $id
 * @property integer $post_id
 * @property string $name
 * @property boolean $moderate
 *
 * @property PostPost $post
 */
class PostVideo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post.post_video';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id'], 'integer'],
            [['moderate'], 'boolean'],
            [['name'], 'string', 'max' => 200],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => PostPost::className(), 'targetAttribute' => ['post_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'post_id' => 'Post ID',
            'name' => 'Name',
            'moderate' => 'Moderate',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(PostPost::className(), ['id' => 'post_id']);
    }
}
