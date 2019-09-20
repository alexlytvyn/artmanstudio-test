<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;
use yii\helpers\VarDumper;

class SignupForm extends Model
{
    public $username;
    public $password;
    public $password_repeat;
    public $email;
    public $captha_string;

    public function rules()
    {
        return [
            [['username', 'password', 'password_repeat', 'email'], 'required'],
            ['username', 'string', 'min' => 4, 'max' => 100],
            [['password', 'password_repeat'], 'string', 'min' => 4, 'max' => 16],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This email address has already been taken.'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password'],
            ['captha_string', 'captcha'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'captha_string' => 'Captcha Verification Code',
        ];
    }

    public function signup()
    {
        $user = new User();
        $user->username = $this->username;
        $user->password = \Yii::$app->security->generatePasswordHash($this->password);
        $user->email = $this->email;
        $user->access_token = \Yii::$app->security->generateRandomString();
        $user->auth_key = \Yii::$app->security->generateRandomString();

        if ($user->validate() && $user->save()) {
            return true;
        }

        \Yii::error("The user was not saved!" . VarDumper::dumpAsString($user->errors));

        return false;
    }    
}
