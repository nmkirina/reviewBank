<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "object.author".
 *
 * @property integer $id
 * @property string $name
 * @property string $range
 * @property string $wikilink
 *
 * @property ObjectObject[] $objectObjects
 */
class Author extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'object.author';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'range', 'wikilink'], 'string', 'max' => 355],
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
            'range' => 'Range',
            'wikilink' => 'Wikilink',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectObjects()
    {
        return $this->hasMany(ObjectObject::className(), ['author_id' => 'id']);
    }
}
