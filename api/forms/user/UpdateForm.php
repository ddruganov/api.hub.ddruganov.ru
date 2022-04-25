<?php

namespace api\forms\user;

use ddruganov\Yii2ApiAuth\forms\user\UpdateForm as BaseUpdateForm;
use yii\base\Model;

final class UpdateForm extends BaseUpdateForm
{
    public ?bool $isBanned = null;

    public function rules()
    {
        return array_merge(parent::rules(), [
            [['isBanned'], 'required']
        ]);
    }

    protected function setCustomAttributes(Model $model)
    {
        parent::setCustomAttributes($model);
        $model->setAttributes([
            'is_banned' => $this->isBanned
        ]);
    }
}
