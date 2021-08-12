<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user = false;  // в данном приватном свойстве будет храниться обьект пользователя


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],  // кастомный валидатор, описан ниже
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        /*Если небыло ошибок при валидации то...*/
        if (!$this->hasErrors()) {
            /*...то мы получаем обьект пользователя*/
            $user = $this->getUser();

            /*Проверяем, если юзер false и прошла ошибка валидации то...  */
            if (!$user || !$user->validatePassword($this->password)) {
                /*...выкидываем ошибку*/
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
            /*Метод логин валидирует данные. И если валидация прошлы - вызывается метод
        Логин(компонента юзер, метод описан в фреймворке) - который аутентифицирует пользователя*/
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        /*Если приватное свойство пустое ($_user = false) то...*/
        if ($this->_user === false) {
            /*...ищем пользователя по его юзернейм и возвращает его*/
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}
