<?php

namespace api\controllers;

use api\forms\role\CreateForm;
use api\forms\role\DeleteForm;
use api\forms\role\UpdateForm;
use ddruganov\Yii2ApiAuth\http\controllers\SecureApiController;
use ddruganov\Yii2ApiAuth\http\filters\RbacFilter;
use ddruganov\Yii2ApiEssentials\http\actions\FormAction;

final class RoleController extends SecureApiController
{
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'rbac' => [
                'class' => RbacFilter::class,
                'rules' => [
                    'create' => 'role.create',
                    'update' => 'role.edit',
                    'delete' => 'role.delete',
                ]
            ]
        ]);
    }

    public function actions()
    {
        return [
            'create' => [
                'class' => FormAction::class,
                'formClass' => CreateForm::class
            ],
            'update' => [
                'class' => FormAction::class,
                'formClass' => UpdateForm::class
            ],
            'delete' => [
                'class' => FormAction::class,
                'formClass' => DeleteForm::class
            ],
        ];
    }
}
