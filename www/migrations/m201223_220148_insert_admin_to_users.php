<?php

use yii\db\Migration;

/**
 * Class m201223_220148_insert_admin_to_users
 */
class m201223_220148_insert_admin_to_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('users', [
            'username' => 'admin',
            'password' => Yii::$app->security->generatePasswordHash('admin'),
            'birthday' => '1989-12-18',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('users', ['username' => 'admin']);
    }
}
