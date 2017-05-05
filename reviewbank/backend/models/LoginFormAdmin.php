<?php
namespace backend\models;
use common\models\LoginForm;

class LoginFormAdmin extends LoginForm {
    
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = UserAdmin::findByEmail($this->email);
        }

        return $this->_user;
    }
}

