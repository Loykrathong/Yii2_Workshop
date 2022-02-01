<?php

namespace app\models;

use Yii;
/* 
@property int $id;
@property string $username;
@property string $password;
@property string $authKey;
@property string $accessToken;
*/
class User_SQL extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface

{

    public static function tableName(){
        return 'q_user';
    }
    
    public function rules()
    {
        return [
            [['username', 'email','password'], 'required'],
            ['username', 'unique','targetClass' => '\app\models\User_SQL' , 'message' => 'This username has already taken'], 
            [['username','email'], 'string','max' => 80],
            [['password','authKey','accessToken'],'string' , 'max' => 255], 
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Username',
            'email' => 'E-mail',
            'password' => 'Password',
        ];
    }



    public static function findIdentity($id)
    {
        return self::findOne($id);
    }


    public static function findIdentityByAccessToken($token, $type = null)
    {
        return self::findOne(['accessToken' => $token]);
    }


    public static function findByUsername($username)
    {
        return self::findOne(['username' => $username]);
    }


    public function getId()
    {
        return $this->id;
    }


    public function getAuthKey()
    {
        return $this->authKey;
    }

  
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    public function validatePassword($password)
    {
        return password_verify($password,$this->password);
    }

}
