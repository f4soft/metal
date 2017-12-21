<?php

namespace app\models\Forms;

use Yii;
use app\models\BaseModel;
use app\models\User;

class SignupForm extends BaseModel
{
    public $company;
    public $city;
    public $okpo;
    public $inn;
    public $phone;
    public $email;
    public $message;
    public $password;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    public function behaviors()
    {
        return [];
    }

    public function rules()
    {
        return [
            [['name', 'company', 'okpo', 'city', 'email', 'phone', 'message'], 'trim'],

            [['name', 'city', 'phone', 'email'], 'required', 'message' => Yii::t('app', 'Это обязательное поле')],
            ['company', 'unique', 'targetClass' => 'app\models\User', 'message' => Yii::t('app', 'Это имя уже используется')],
            ['company', 'string', 'min' => 2, 'max' => 255, 'message' => Yii::t('app', 'Поле должно быть длинною от 2 до 255 символов')],

            [['email'], 'email', 'message' => Yii::t('app', 'Поле должно содержать валидный емаил адрес')],
            ['email', 'string', 'max' => 255, 'message' => Yii::t('app', 'Поле должно быть длинною не более 255 символов')],
            ['email', 'unique', 'targetClass' => 'app\models\User', 'message' => Yii::t('app', 'Этот имейл уже используется')],

            ['okpo', 'string', 'max' => 25, 'message' => Yii::t('app', 'Поле должно быть длинною не более 25 символов')],
            ['city', 'string', 'max' => 255, 'message' => Yii::t('app', 'Поле должно быть длинною не более 255 символов')],
            ['message', 'string', 'min' => 0, 'max' => 255, 'message' => Yii::t('app', 'Поле должно быть длинною не более 255 символов')],
            ['phone', 'string', 'max' => 15, 'message' => Yii::t('app', 'Поле должно быть длинною не более 15 символов')],            
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->name = $this->name;
        $user->company = $this->company ? $this->company : NULL;
        $user->okpo = $this->okpo ? $this->okpo : NULL;        
        $user->email = $this->email;
        $user->city = $this->city;
        $user->phone = $this->phone;
        $user->message = $this->message;
        $this->generatePassword();
        $user->setPassword($this->password);
        $user->generateAuthKey();

        return $user->save() ? $user : null;
    }


    /**
     * Generates passwords
     *
     * @param integer $length
     */
    public function generatePassword($length = 5)
    {
        $chars = array_merge(range(1, 9), range('a', 'z'));
        shuffle($chars);
        $this->password = implode(array_slice($chars, 0, $length));
    }
}

