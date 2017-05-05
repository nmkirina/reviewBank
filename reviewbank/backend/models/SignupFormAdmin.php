<?php
namespace backend\models;

use yii\base\Model;

use backend\models\UserAdmin;

class SignupFormAdmin extends Model {
    
    public $email;
    public $password;
    
    public function rules()
    {
        return [

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => 'UserAdmin', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }    
            
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new UserAdmin();
        $user->email = $this->email;
        $user->setPassword($this->password);
        return $user->save() ? $user : null;
    }
}

