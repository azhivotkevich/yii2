<?php

use yii\db\Migration;

/**
 * Class m210122_092434_add_updated_add_to_users
 */
class m210122_092434_add_updated_add_to_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('users', 'updated_at', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('users', 'updated_at');
    }
}
