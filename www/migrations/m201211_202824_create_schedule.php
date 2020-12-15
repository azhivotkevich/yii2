<?php

use app\components\db\Migration;


/**
 * Class m201211_202824_create_schedule
 */
class m201211_202824_create_schedule extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('daily_schedule', [
            'id' => $this->primaryKey(),
            'cabinet_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'date' => $this->date()->notNull(),
            'time_from' => $this->time()->notNull(),
            'time_to' => $this->time()->notNull(),
            'status' => $this->enum(['new', 'active', 'disabled'], 'new')
        ]);

        $this->addCustomForeignKey('daily_schedule', 'cabinet_id', 'cabinets', 'id');
        $this->addCustomForeignKey('daily_schedule', 'user_id', 'users', 'id');

        $this->createTable('weekly_schedule', [
            'id' => $this->primaryKey(),
            'cabinet_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'day' => $this->smallInteger()->notNull(),
            'time_from' => $this->time()->notNull(),
            'time_to' => $this->time()->notNull(),
            'status' => 'ENUM("new", "active", "disabled") DEFAULT "new"'
        ]);

        $this->addCustomForeignKey('weekly_schedule', 'cabinet_id', 'cabinets', 'id');
        $this->addCustomForeignKey('weekly_schedule', 'user_id', 'users', 'id');

        $this->createTable('monthly_schedule', [
            'id' => $this->primaryKey(),
            'cabinet_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'day' => $this->smallInteger()->notNull(),
            'time_from' => $this->time()->notNull(),
            'time_to' => $this->time()->notNull(),
            'status' => 'ENUM("new", "active", "disabled") DEFAULT "new"'
        ]);

        $this->addCustomForeignKey('monthly_schedule', 'cabinet_id', 'cabinets', 'id');
        $this->addCustomForeignKey('monthly_schedule', 'user_id', 'users', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            $this->createFKName('daily_schedule', 'cabinet_id', 'cabinets', 'id'),
            'daily_schedule'
        );
        $this->dropForeignKey(
            $this->createFKName('daily_schedule', 'user_id', 'users', 'id'),
            'daily_schedule'
        );
        $this->dropTable('daily_schedule');

        $this->dropForeignKey(
            $this->createFKName('weekly_schedule', 'cabinet_id', 'cabinets', 'id'),
            'weekly_schedule'
        );
        $this->dropForeignKey(
            $this->createFKName('weekly_schedule', 'user_id', 'users', 'id'),
            'weekly_schedule'
        );
        $this->dropTable('weekly_schedule');

        $this->dropForeignKey(
            $this->createFKName('monthly_schedule', 'cabinet_id', 'cabinets', 'id'),
            'weekly_schedule'
        );
        $this->dropForeignKey(
            $this->createFKName('monthly_schedule', 'user_id', 'users', 'id'),
            'weekly_schedule'
        );
        $this->dropTable('monthly_schedule');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201211_202824_create_schedule cannot be reverted.\n";

        return false;
    }
    */
}
