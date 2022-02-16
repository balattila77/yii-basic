<?php

use yii\db\Migration;

/**
 * Class m220211_094254_crete_user_groups_table
 */
class m220211_094254_crete_user_groups_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user_groups', [
            'id' => $this->primaryKey()->unsigned(),
            'user_id' => $this->integer()->unsigned()->notNull(),
            'group_id' => $this->integer()->unsigned()->notNull()
        ]);        

        $this->addForeignKey(
            'fk-user_groups-group_id',
            'user_groups',
            'group_id',
            'group',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-user_groups-user_id',
            'user_groups',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-user_groups-user_id',
            'user_groups'
        );

        $this->dropForeignKey(
            'fk-user_groups-user_id',
            'user_groups'
        );

        $this->dropTable('user_groups');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220211_094254_crete_user_groups_table cannot be reverted.\n";

        return false;
    }
    */
}
