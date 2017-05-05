<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "user.user".
 *
 * @property integer $id
 * @property string $nickname
 * @property string $email
 * @property string $password
 * @property string $photo
 * @property string $created_at
 * @property string $las_login
 * @property string $role
 * @property integer $status
 * @property string $updated_at
 * @property string $auth_key
 *
 * @property PostPost[] $postPosts
 * @property UserCollection[] $userCollections
 * @property UserComment[] $userComments
 * @property UserWishlist[] $userWishlists
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user.user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'password', 'created_at'], 'required'],
            [['created_at', 'las_login', 'updated_at'], 'safe'],
            [['role', 'auth_key'], 'string'],
            [['status'], 'integer'],
            [['nickname', 'password'], 'string', 'max' => 50],
            [['email'], 'string', 'max' => 355],
            [['photo'], 'string', 'max' => 100],
            [['email'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nickname' => 'Nickname',
            'email' => 'Email',
            'password' => 'Password',
            'photo' => 'Photo',
            'created_at' => 'Created At',
            'las_login' => 'Las Login',
            'role' => 'Role',
            'status' => 'Status',
            'updated_at' => 'Updated At',
            'auth_key' => 'Auth Key',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostPosts()
    {
        return $this->hasMany(PostPost::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserCollections()
    {
        return $this->hasMany(UserCollection::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserComments()
    {
        return $this->hasMany(UserComment::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserWishlists()
    {
        return $this->hasMany(UserWishlist::className(), ['user_id' => 'id']);
    }
}
