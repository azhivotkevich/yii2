<?php

use yii\db\Migration;

/**
 * Class m201208_195245_create_geo
 */
class m201208_195245_create_geo extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('countries', [
            'id' => $this->primaryKey(),
            'name' => $this->string('255')->notNull()->unique()
        ]);

        $this->createTable('regions', [
            'id' => $this->primaryKey(),
            'country_id' => $this->integer()->notNull(),
            'name' => $this->string('255')->notNull()->unique()
        ]);

        $this->addForeignKey(
            'fk_regions_country_id_countries_id',
            'regions',
            'country_id',
            'countries',
            'id',
            'restrict',
            'cascade'
        );

        $this->createTable('cities', [
            'id' => $this->primaryKey(),
            'region_id' => $this->integer()->notNull(),
            'name' => $this->string('255')->notNull()->unique()
        ]);

        $this->addForeignKey(
            'fk_cities_region_id_regions_id',
            'cities',
            'region_id',
            'regions',
            'id',
            'restrict',
            'cascade'
        );

        $this->createTable('salons', [
            'id' => $this->primaryKey(),
            'city_id' => $this->integer()->notNull(),
            'name' => $this->string('255')->notNull()->unique()
        ]);

        $this->addForeignKey(
            'fk_salons_city_id_cities_id',
            'salons',
            'city_id',
            'cities',
            'id',
            'restrict',
            'cascade'
        );

        $this->createTable('cabinets', [
            'id' => $this->primaryKey(),
            'salon_id' => $this->integer()->notNull(),
            'name' => $this->string('255')->notNull()->unique()
        ]);

        $this->addForeignKey(
            'fk_cabinets_salon_id_salons_id',
            'cabinets',
            'salon_id',
            'salons',
            'id',
            'restrict',
            'cascade'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('countries');
        $this->dropForeignKey('fk_regions_country_id_countries_id', 'regions');
        $this->dropTable('regions');
        $this->dropForeignKey('fk_cities_region_id_regions_id', 'cities');
        $this->dropTable('cities');
        $this->dropForeignKey('fk_salons_city_id_cities_id', 'salons');
        $this->dropTable('salons');
        $this->dropForeignKey('fk_cabinets_salon_id_salons_id', 'cabinets');
        $this->dropTable('cabinets');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201208_195245_create_geo cannot be reverted.\n";

        return false;
    }
    */
}
