<?php

use yii\helpers\ArrayHelper;

return ArrayHelper::merge(
    require Yii::getAlias('@common/config/main-local.php'),
    [
        'id' => 'test',
        'basePath' => Yii::getAlias('@tests')
    ]
);
