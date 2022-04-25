<?php

namespace api\forms\user;

use ddruganov\Yii2ApiAuth\forms\user\CreateForm as BaseCreateForm;
use yii\base\Model;

final class CreateForm extends BaseCreateForm
{
    protected function setCustomAttributes(Model $model)
    {
        parent::setCustomAttributes($model);
        $model->setAttributes([
            'is_banned' => false
        ]);
    }
}
