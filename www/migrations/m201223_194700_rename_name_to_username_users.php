<?php

use yii\db\Migration;

/**
 * Class m201223_194700_rename_name_to_username_users
 */
class m201223_194700_rename_name_to_username_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('users', 'name', 'username');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameColumn('users', 'username', 'name');
    }
}
