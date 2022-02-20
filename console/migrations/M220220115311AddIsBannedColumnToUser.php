<?php

namespace console\migrations;

use yii\db\Migration;

class M220220115311AddIsBannedColumnToUser extends Migration
{
    public function safeUp()
    {
        $this->addColumn('user.user', 'is_banned', $this->boolean()->notNull()->defaultValue(false));
    }

    public function safeDown()
    {
        $this->dropColumn('user.user', 'is_banned');
        return true;
    }
}
