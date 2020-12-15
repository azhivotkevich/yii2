<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m201120_201658_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%users}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'password' => $this->string(255)->notNull(),
            'birthday' => $this->date()->notNull(),
            'created_at' => $this->dateTime()->defaultValue(new \yii\db\Expression('CURRENT_TIMESTAMP')),
            'modified_by' => $this->integer(11)->null(),
            'gender' => "ENUM('male', 'female') NULL",
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%users}}');
    }
}
