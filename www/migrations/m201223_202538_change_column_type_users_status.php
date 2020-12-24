<?php

use yii\db\Migration;

/**
 * Class m201223_202538_change_column_type_users_status
 */
class m201223_202538_change_column_type_users_status extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('users', 'status', $this->boolean()->defaultValue(false));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('users', 'status', 'ENUM("active", "inactive") DEFAULT "inactive"');
    }
}
