<?php

namespace app\models;

use yii\db\ActiveRecord;

class User extends ActiveRecord implements \yii\web\IdentityInterface
{
    /*Модель User наследует класс ActiveRecord для того что бы была возможность работать с БД
    В данном конкретном случае для связки модели Юзер с таблицей Юзер в БД*/

    /*сзявываем данную модель с соотв таблицей бд*/
    public static function tableName()
    {
        return 'user';
    }

    /*метод который получает данные юзера по его id*/
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        /*данный метод нам не нужен но необходимо его оставить так как модель наследует IdentityInterface*/
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    /*Метод представляет собой поиск пользователя по его Логину*/
    public static function findByUsername($username)
    {
        /*связываем В МАССИВЕ свойство юзернейм и данными таблицы*/
        return static::findOne(['username' => $username]);
    }

    /**
     * {@inheritdoc}
     */
    /*метод для возврата id пользователя*/
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    /*Устанавливаем auth_key как в таблице*/
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    /*Устанавливаем auth_key как в таблице*/
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    /*Метод сравнивает имеющийся в хеше пароль с введенным паролем от юзера
    Пароль будет в ХЕШИРОВАНОМ виде для этого используем:
    $hash = Yii::$app->getSecurity()->generatePasswordHash($password); из документации */
    public function validatePassword($password)
    {
        /*Смотрим на документацию раздел Безопасность - Работа с паролями и делаем как показано:*/
        return \Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }

    /*Напишем метод который при авторизации(если все прошло успешно) сгенерирует значение,
    которое в дальнейшем запишется в таблице юзерс в строке данного пользователя в поле auth_key
    Это значение нам необходимо на случай восстановления пароля данного юзера*/
    public function generateAuthKey()
    {
        $this->auth_key = \Yii::$app->security->generateRandomString();
    }
}

















