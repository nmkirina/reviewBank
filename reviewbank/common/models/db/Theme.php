<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "post.theme".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 *
 * @property PostPost[] $postPosts
 */
class Theme extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post.theme';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostPosts()
    {
        return $this->hasMany(PostPost::className(), ['theme_id' => 'id']);
    }
}
