<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%contact_types}}`.
 */
class m201127_193712_create_contact_types_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%contact_types}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string('100')->notNull()->unique(),
            'created_at' => $this->dateTime()->defaultValue(new \yii\db\Expression('CURRENT_TIMESTAMP')),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%contact_types}}');
    }
}
