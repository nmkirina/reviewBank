<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "user.comment".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $body
 *
 * @property UserUser $user
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user.comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'user_id'], 'integer'],
            [['body'], 'string'],
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
            'body' => 'Body',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(UserUser::className(), ['id' => 'user_id']);
    }
}
