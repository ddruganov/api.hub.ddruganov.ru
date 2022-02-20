<?php

namespace api\forms\user;

use api\models\user\User;
use Yii;
use yii\base\Model;

final class CreateForm extends BaseForm
{
    public ?string $password = null;

    public function rules()
    {
        return array_merge(parent::rules(), [
            [['email'], 'unique', 'targetClass' => User::class, 'message' => 'Такой пользователь уже существует'],
            [['password'], 'required', 'message' => 'Поле "{attribute}" обязательно для заполнения'],
            [['password'], 'string', 'min' => 6, 'tooShort' => 'Пароль не может быть короче 6 символов'],
        ]);
    }

    public function attributeLabels()
    {
        return parent::attributeLabels() + [
            'password' => 'Пароль',
        ];
    }

    protected function setCustomAttributes(Model $model)
    {
        $model->setAttributes([
            'password' => Yii::$app->getSecurity()->generatePasswordHash($this->password)
        ]);
    }
}
