<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%contacts}}`.
 */
class m201127_200521_create_contacts_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%contacts}}', [
            'type_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'value' => $this->string('255')->notNull(),
        ]);

        $this->addPrimaryKey('pk_contacts_type_id_user_id', '{{%contacts}}', ['type_id', 'user_id']);
        $this->addForeignKey(
            'fk_contacts_type_id_contact_types_id',
            '{{%contacts}}',
            'type_id',
            'contact_types',
            'id',
            'restrict',
            'cascade'
        );
        $this->addForeignKey(
            'fk_contacts_user_id_users_id',
            '{{%contacts}}',
            'user_id',
            'users',
            'id',
            'cascade',
            'cascade'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_contacts_type_id_contact_types_id', '{{%contacts}}');
        $this->dropForeignKey('fk_contacts_user_id_users_id', '{{%contacts}}');
        $this->dropTable('{{%contacts}}');
    }
}
