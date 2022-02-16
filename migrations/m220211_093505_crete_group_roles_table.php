<?php

use yii\db\Migration;

/**
 * Class m220211_093505_crete_group_roles_table
 */
class m220211_093505_crete_group_roles_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('group_roles', [
            'id' => $this->primaryKey()->unsigned(),
            'group_id' => $this->integer()->unsigned()->notNull(),
            'controller' => $this->string(64)->key()->notNull(),
            'create' => $this->boolean()->defaultValue(false),
            'read' => $this->boolean()->defaultValue(false),
            'update' => $this->boolean()->defaultValue(false),
            'delete' => $this->boolean()->defaultValue(false),
        ]);

        $this->addForeignKey(
            'fk-group_roles-group_id',
            'group_roles',
            'group_id',
            'group',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220211_093505_crete_group_roles_table cannot be reverted.\n";
        $this->dropForeignKey(
            'fk-group_roles-group_id',
            'group_roles'
        );

        $this->dropTable('group_roles');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220211_093505_crete_group_roles_table cannot be reverted.\n";

        return false;
    }
    */
}
