<?php

use yii\db\Migration;

/**
 * Class m201208_180148_add_user_fields
 */
class m201208_180148_add_user_fields extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('users', 'first_name', $this->string('255')->null());
        $this->addColumn('users', 'second_name', $this->string('255')->null());
        $this->addColumn('users', 'last_name', $this->string('255')->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('users', 'first_name');
        $this->dropColumn('users', 'second_name');
        $this->dropColumn('users', 'last_name');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201208_180148_add_user_fields cannot be reverted.\n";

        return false;
    }
    */
}
