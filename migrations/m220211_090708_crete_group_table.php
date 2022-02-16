<?php

use yii\db\Migration;

/**
 * Class m220211_090708_crete_group_table
 */
class m220211_090708_crete_group_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('group',[
            'id' => $this->PrimaryKey()->unsigned(),
            'title' => $this->string(30)->unique()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220211_090708_crete_group_table cannot be reverted.\n";
        $this->dropTable('group');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220211_090708_crete_group_table cannot be reverted.\n";

        return false;
    }
    */
}
