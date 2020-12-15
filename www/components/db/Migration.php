<?php

namespace app\components\db;

class Migration extends \yii\db\Migration
{
    public function createFKName(string $table, string $column, string $refTable, string $refColumn): string
    {
        return "fk_{$table}_{$column}_{$refTable}_{$refColumn}";
    }

    public function addCustomForeignKey(
        string $table,
        string $column,
        string $refTable,
        string $refColumn,
        string $delete = 'restrict',
        string $update = 'cascade'
    )
    {
        $name = $this->createFKName($table, $column, $refTable, $refColumn);
        parent::addForeignKey($name, $table, $column, $refTable, $refColumn, $delete, $update);
    }

    public function enum(array $values, $default = null): string
    {
        $values = implode('","', $values);
        $default = $default ? " DEFAULT \"{$default}\"" : '' ;
        return "ENUM(\"{$values}\"){$default}";
    }
}