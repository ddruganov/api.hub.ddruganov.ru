<?php

use yii\helpers\ArrayHelper;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../vendor/yiisoft/yii2/Yii.php';
require __DIR__ . '/../../common/config/bootstrap.php';

$config = ArrayHelper::merge(
    require Yii::getAlias('@api/config/main.php'),
    require Yii::getAlias('@tests/config/main.php')
);

$application = new yii\console\Application($config);
