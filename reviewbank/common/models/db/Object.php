<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "object.object".
 *
 * @property integer $id
 * @property integer $author_id
 * @property string $name
 * @property string $origin_name
 * @property string $year
 * @property string $wikilink
 *
 * @property ObjectAuthor $author
 * @property PostPost[] $postPosts
 */
class Object extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'object.object';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['author_id'], 'integer'],
            [['name', 'origin_name', 'wikilink'], 'string', 'max' => 355],
            [['year'], 'string', 'max' => 50],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => ObjectAuthor::className(), 'targetAttribute' => ['author_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'author_id' => 'Author ID',
            'name' => 'Name',
            'origin_name' => 'Origin Name',
            'year' => 'Year',
            'wikilink' => 'Wikilink',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(ObjectAuthor::className(), ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostPosts()
    {
        return $this->hasMany(PostPost::className(), ['object_id' => 'id']);
    }
}
