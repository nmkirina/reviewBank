<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "user.wishlist".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $object_id
 * @property string $created_on
 *
 * @property ObjectObject $object
 * @property UserUser $user
 */
class Wishlist extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user.wishlist';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'user_id', 'object_id'], 'integer'],
            [['created_on'], 'safe'],
            [['object_id'], 'exist', 'skipOnError' => true, 'targetClass' => ObjectObject::className(), 'targetAttribute' => ['object_id' => 'id']],
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
            'object_id' => 'Object ID',
            'created_on' => 'Created On',
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
    public function getUser()
    {
        return $this->hasOne(UserUser::className(), ['id' => 'user_id']);
    }
}
