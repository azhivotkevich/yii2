<?php

use yii\db\Migration;

/**
 * Class m201120_203956_add_user_status
 */
class m201120_203956_add_user_status extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%users}}', 'status', 'ENUM("active", "inactive") DEFAULT "inactive"');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%users}}', 'status');
    }
}
