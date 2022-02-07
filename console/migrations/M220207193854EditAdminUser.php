<?php

namespace console\migrations;

use yii\db\Migration;

class M220207193854EditAdminUser extends Migration
{
    public function safeUp()
    {
        $this->update('user.user', ['email' => 'ddruganov@bk.ru'], ['email' => 'admin@yourdomain.com']);
    }

    public function safeDown()
    {
        $this->update('user.user', ['email' => 'admin@yourdomain.com'], ['email' => 'ddruganov@bk.ru']);
        return true;
    }
}
