<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user.user_admin".
 *
 * @property integer $id
 * @property string $email
 * @property string $password
 * @property string $created_at
 * @property string $last_login
 * @property string $auth_key
 */
class UserAdmin extends \yii\db\ActiveRecord
{
    public $email;
    public $password;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user.user_admin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'email'], 'required'],
            [['id'], 'integer'],
            [['email', 'password', 'auth_key'], 'string'],
            [['created_at', 'last_login'], 'safe'],
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
            'email' => 'Email',
            'password' => 'Password',
            'created_at' => 'Created At',
            'last_login' => 'Last Login',
            'auth_key' => 'Auth Key',
        ];
    }
     public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }
    
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }
}
